<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $alat = Alat::all();
        return response()->json([
            'data' => $alat
        ]);
    }

    public function show($id)
    {
        $alat = Alat::findOrFail($id);
        return response()->json([
            'data' => $alat
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategori,id',
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'hargaperhari' => 'required|integer',
            'stok' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal menambahkan data alat!',
                'errors' => $validator->errors()
            ], 422);
        }

        $alat = Alat::create($request->all());
        return response()->json([
            'data' => $alat
        ]);
    }

    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategori,id',
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'hargaperhari' => 'required|integer',
            'stok' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal mengubah data alat!',
                'errors' => $validator->errors()
            ], 422);
        }

        $alat->update($request->all());
        return response()->json([
            'data' => $alat
        ]);
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return response()->json([
            'msg' => 'Data alat berhasil dihapus!'
        ]);
    }
}
