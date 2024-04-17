<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PenyewaanDetail;
use App\Models\Penyewaan;
use App\Models\Alat;
use Illuminate\Http\Request;

class PenyewaanDetailController extends Controller
{
    public function index()
    {
        $penyewaan_detail = PenyewaanDetail::all();
        return response()->json([
            'data' => $penyewaan_detail
        ]);
    }

    public function show($id)
    {
        $penyewaan_detail = PenyewaanDetail::findOrFail($id);
        return response()->json([
            'data' => $penyewaan_detail
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penyewaan_id' => 'required|exists:penyewaan,id',
            'alat_id' => 'required|exists:alat,id',
            'jumlah' => 'required|integer',
            'subharga' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal menambahkan data penyewaan detail!',
                'errors' => $validator->errors()
            ], 422);
        }

        $penyewaan_detail = PenyewaanDetail::create($request->all());
        return response()->json([
            'data' => $penyewaan_detail
        ]);
    }

    public function update(Request $request, $id)
    {
        $penyewaan_detail = PenyewaanDetail::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'penyewaan_id' => 'required|exists:penyewaan,id',
            'alat_id' => 'required|exists:alat,id',
            'jumlah' => 'required|integer',
            'subharga' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal mengubah data penyewaan detail!',
                'errors' => $validator->errors()
            ], 422);
        }

        $penyewaan_detail->update($request->all());
        return response()->json([
            'data' => $penyewaan_detail
        ]);
    }

    public function destroy($id)
    {
        $penyewaan_detail = PenyewaanDetail::findOrFail($id);
        $penyewaan_detail->delete();

        return response()->json([
            'msg' => 'Data penyewaan detail berhasil dihapus!'
        ]);
    }
}
