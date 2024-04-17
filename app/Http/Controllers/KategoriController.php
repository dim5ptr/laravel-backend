<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json([
            'data' => $kategori
        ]);
    }

    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->json([
            'data' => $kategori
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal menambahkan data kategori!',
                'errors' => $validator->errors()
            ], 422);
        }

        $kategori = Kategori::create($request->all());
        return response()->json([
            'data' => $kategori
        ]);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal mengubah data kategori!',
                'errors' => $validator->errors()
            ], 422);
        }

        $kategori->update($request->all());
        return response()->json([
            'data' => $kategori
        ]);
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json([
            'msg' => 'Data kategori berhasil dihapus!'
        ]);
    }
}
