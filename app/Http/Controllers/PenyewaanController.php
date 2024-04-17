<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    public function index()
    {
        $penyewaan = Penyewaan::all();
        return response()->json([
            'data' => $penyewaan
        ]);
    }

    public function show($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);
        return response()->json([
            'data' => $penyewaan
        ]);
    }

public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'tgl_sewa' => 'required|date',
            'tgl_kembali' => 'required|date',
            'status_pembayaran' => 'required|string|max:10',
            'status_kembali' => 'required|string|max:10',
            'total_harga' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal menambahkan data penyewaan!',
                'errors' => $validator->errors()
            ], 422);
        }

        $penyewaan = Penyewaan::create($request->all());
        return response()->json([
            'data' => $penyewaan
        ]);
    }

    public function update(Request $request, $id)
    {
        $penyewaan = Penyewaan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'tgl_sewa' => 'required|date',
            'tgl_kembali' => 'required|date',
            'status_pembayaran' => 'required|string|max:10',
            'status_kembali' => 'required|string|max:10',
            'total_harga' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal mengubah data penyewaan!',
                'errors' => $validator->errors()
            ], 422);
        }

        $penyewaan->update($request->all());
        return response()->json([
            'data' => $penyewaan
        ]);
    }

    public function destroy($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);
        $penyewaan->delete();

        return response()->json([
            'msg' => 'Data penyewaan berhasil dihapus!'
        ]);
    }
}
