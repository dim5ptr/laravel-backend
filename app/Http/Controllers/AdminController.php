<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return response()->json([
            'data' => $admin
        ]);
    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return response()->json([
            'data' => $admin
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50',
            'password' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal menambahkan data admin!',
                'errors' => $validator->errors()
            ], 422);
        }

        $admin = Admin::create($request->all());
        return response()->json([
            'data' => $admin
        ]);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50',
            'password' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal mengubah data admin!',
                'errors' => $validator->errors()
            ], 422);
        }

        $admin->update($request->all());
        return response()->json([
            'data' => $admin
        ]);
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return response()->json([
            'msg' => 'Data admin berhasil dihapus!'
        ]);
    }
}
