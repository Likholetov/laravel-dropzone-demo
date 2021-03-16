<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('files'), $fileName);
        Excel::import(new UsersImport, public_path('files/' . $fileName));

        return response()->json(['file' => $fileName]);
    }
}
