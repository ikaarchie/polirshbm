<?php

namespace App\Http\Controllers;

use App\Models\User;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Models\AntrianPoliklinik;
use App\Models\PanggilAntrianPoliklinik;

use App\Events\ServerCreated;

class AntrianPoliController extends Controller
{
    public function show(Request $request)
    {
        $query = AntrianPoliklinik::query();
        $dokter = User::where('department', 'Dokter Spesialis')->orderBy('name', 'ASC')->get();

        if ($request->ajax()) {
            $list_antrian = $query->where(['namadokter' => $request->dokter])->get();
            return response()->json(['list_antrian' => $list_antrian]);
        }

        $list_antrian = $query->latest('id')->paginate(1000);

        return view('input_antrian', compact('dokter', 'list_antrian'));
    }

    public function save(Request $request)
    {
        $data = new AntrianPoliklinik();
        $data->namadokter = $request->input('namadokter');
        $data->pembayaran = $request->input('pembayaran');
        $data->namapasien = $request->input('namapasien');
        $data->status_panggil = 'Menunggu'; // ['Menunggu', 'Dipanggil', 'Selesai']
        $data->save();

        return redirect('/input')->with('success', 'Data berhasil disimpan!');
    }

    public function panggil(Request $request)
    {
        $query = AntrianPoliklinik::query();
        $dokter = User::where('department', 'Dokter Spesialis')->orderBy('name', 'ASC')->get();

        if ($request->ajax()) {
            $panggil_antrian = $query->where(['namadokter' => $request->dokter])->get();
            return response()->json(['panggil_antrian' => $panggil_antrian]);
        }

        $panggil_antrian = $query->latest('id')->paginate(1000);

        return view('panggil_antrian', compact('dokter', 'panggil_antrian'));
    }

    public function savepanggil(Request $request, $id)
    {
        $panggil = PanggilAntrianPoliklinik::where(['id' => $id])->first();
        $panggil->status_panggil = 'Dipanggil';
        $panggil->save();

        ServerCreated::dispatch();

        return redirect('/panggil')->with('success', 'Antrian dipanggil');
    }

    public function display(Request $request)
    {
        $display = AntrianPoliklinik::whereIn('status_panggil', array('Dipanggil', 'Menunggu'))->orderBy('status_panggil', 'asc')->get();

        if ($request->expectsJson()) {
            return response()->json(['data' => $display], 200);
        }

        return view('display_antrian')->with('display', $display);
    }
}
