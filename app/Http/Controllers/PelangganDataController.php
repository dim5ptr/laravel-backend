<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PelangganData;
use Illuminate\Http\Request;

class PelangganDataController extends Controller
{
    public function index()
    {
        $pelanggan_data = PelangganData::all();
        return response()->json([
            'data' => $pelanggan_data
        ]);
    }

    public function show($id)
    {
        $pelanggan_data = PelangganData::findOrFail($id);
        return response()->json([
            'data' => $pelanggan_data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'jenis' => 'required|string|max:10',
            'file' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal menambahkan data pelanggan data!',
                'errors' => $validator->errors()
            ], 422);
        }

        $pelanggan_data = PelangganData::create($request->all());
        return response()->json([
            'data' => $pelanggan_data
        ]);
    }

    public function update(Request $request, $id)
    {
        $pelanggan_data = PelangganData::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'jenis' => 'required|string|max:10',
            'file' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Gagal mengubah data pelanggan data!',
                'errors' => $validator->errors()
            ], 422);
        }

        $pelanggan_data->update($request->all());
        return response()->json([
            'data' => $pelanggan_data
        ]);
    }

    public function destroy($id)
    {
        $pelanggan_data = PelangganData::findOrFail($id);
        $pelanggan_data->delete();

        return response()->json([
            'msg' => 'Data pelanggan data berhasil dihapus!'
        ]);
    }
}
