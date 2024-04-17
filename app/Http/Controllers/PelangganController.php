<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return response()->json([
            'data' => $pelanggan
        ]);
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return response()->json([
            'data' => $pelanggan
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:150',
            'alamat' => 'required|string|max:200',
            'notelp' => 'required|string|max:13',
            'email' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal menambahkan data pelanggan!',
                'errors' => $validator->errors()
            ], 422);
        }

        $pelanggan = Pelanggan::create($request->all());
        return response()->json([
            'data' => $pelanggan
        ]);
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:150',
            'alamat' => 'required|string|max:200',
            'notelp' => 'required|string|max:13',
            'email' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal mengubah data pelanggan!',
                'errors' => $validator->errors()
            ], 422);
        }

        $pelanggan->update($request->all());
        return response()->json([
            'data' => $pelanggan
        ]);
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return response()->json([
            'msg' => 'Data pelanggan berhasil dihapus!'
        ]);
    }
}
