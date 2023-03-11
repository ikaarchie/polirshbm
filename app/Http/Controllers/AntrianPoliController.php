<?php

namespace App\Http\Controllers;

use App\Models\User;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Events\ServerCreated;

use App\Models\AntrianPoliklinik;
use Illuminate\Support\Facades\DB;
use App\Models\PanggilAntrianPoliklinik;

class AntrianPoliController extends Controller
{
    public function showEkse(Request $request)
    {
        $query = AntrianPoliklinik::query();
        $dokter = User::where('department', 'Dokter Spesialis')->orderBy('name', 'ASC')->get();

        if ($request->ajax()) {
            $list_antrian = $query->where('jenis_poli', 'Eksekutif')->where(['nama_dokter' => $request->dokter])->get();
            return response()->json(['list_antrian' => $list_antrian]);
        }

        $list_antrian = $query->where('jenis_poli', 'Eksekutif')->latest('id')->paginate(1000);

        return view('ekse.input_antrian', compact('dokter', 'list_antrian'));
    }

    public function saveEkse(Request $request)
    {
        $data = new AntrianPoliklinik();
        $data->nama_dokter = $request->input('nama_dokter');
        $data->waktu_praktek = $request->input('waktu_praktek');
        $data->jenis_poli = 'Eksekutif';
        $data->nama_pasien = $request->input('nama_pasien');
        $data->status_panggil = 'Menunggu'; // ['Menunggu', 'Dipanggil', 'Selesai']
        $data->save();

        return redirect('/ekse/input')->with('success', 'Data berhasil disimpan!');
    }

    public function panggilEkse(Request $request)
    {
        $query = AntrianPoliklinik::query();
        $dokter = User::where('department', 'Dokter Spesialis')->orderBy('name', 'ASC')->get();

        if ($request->ajax()) {
            $panggil_antrian = $query->where('jenis_poli', 'Eksekutif')->where(['nama_dokter' => $request->dokter])->get();
            return response()->json(['panggil_antrian' => $panggil_antrian]);
        }

        $panggil_antrian = $query->where('jenis_poli', 'Eksekutif')->latest('id')->paginate(1000);

        return view('ekse.panggil_antrian', compact('dokter', 'panggil_antrian'));
    }

    public function savepanggilEkse(Request $request, $id)
    {
        $panggil = AntrianPoliklinik::where(['id' => $id])->first();
        $panggil->status_panggil = 'Dipanggil';
        $panggil->save();
        ServerCreated::dispatch();
        return redirect('/ekse/panggil')->with('success', 'Antrian dipanggil');


        // $panggil = AntrianPoliklinik::where(['id' => $id])->first();
        // $panggil->status_panggil = 'Dipanggil';
        // $panggil->save();
        // $html = view('ekse.panggil_antrian', compact('panggil'))->render();
        // return response()->json(['html' => $html]);
        // ServerCreated::dispatch();

        // AntrianPoliklinik::where('id', $request->id)->update([
        //     'status_panggil' => $request->status_panggil
        // ]);
        // ServerCreated::dispatch();
        // return response()->json([
        //     'status' => 'success',
        // ]);
    }

    public function savependingEkse(Request $request, $id)
    {
        $pending = AntrianPoliklinik::where(['id' => $id])->first();
        $pending->status_panggil = 'Dipending';
        $pending->save();

        ServerCreated::dispatch();

        return redirect('/ekse/panggil')->with('success', 'Antrian dipending');
    }

    public function saveselesaiEkse(Request $request, $id)
    {
        $selesai = AntrianPoliklinik::where(['id' => $id])->first();
        $selesai->status_panggil = 'Selesai';
        $selesai->save();

        ServerCreated::dispatch();

        return redirect('/ekse/panggil')->with('success', 'Antrian selesai');
    }

    public function displayEkse(Request $request)
    {
        $display = AntrianPoliklinik::whereIn('status_panggil', array('Dipanggil', 'Menunggu'))->orderBy('status_panggil', 'asc')->get();

        if ($request->expectsJson()) {
            return response()->json(['data' => $display], 200);
        }

        return view('ekse.display_antrian')->with('display', $display);
    }



    public function showReg(Request $request)
    {
        $query = AntrianPoliklinik::query();
        $dokter = User::where('department', 'Dokter Spesialis')->orderBy('name', 'ASC')->get();

        if ($request->ajax()) {
            $list_antrian = $query->where('jenis_poli', 'Reguler')->where(['nama_dokter' => $request->dokter])->get();
            return response()->json(['list_antrian' => $list_antrian]);
        }

        $list_antrian = $query->where('jenis_poli', 'Reguler')->latest('id')->paginate(1000);

        return view('reg.input_antrian', compact('dokter', 'list_antrian'));
    }

    public function saveReg(Request $request)
    {
        $data = new AntrianPoliklinik();
        $data->nama_dokter = $request->input('nama_dokter');
        $data->waktu_praktek = $request->input('waktu_praktek');
        $data->jenis_poli = 'Reguler';
        $data->nama_pasien = $request->input('nama_pasien');
        $data->status_panggil = 'Menunggu'; // ['Menunggu', 'Dipanggil', 'Selesai']
        $data->save();

        return redirect('/reg/input')->with('success', 'Data berhasil disimpan!');
    }

    public function panggilReg(Request $request)
    {
        $query = AntrianPoliklinik::query();
        $dokter = User::where('department', 'Dokter Spesialis')->orderBy('name', 'ASC')->get();

        if ($request->ajax()) {
            $panggil_antrian = $query->where('jenis_poli', 'Reguler')->where(['nama_dokter' => $request->dokter])->get();
            return response()->json(['panggil_antrian' => $panggil_antrian]);
        }

        $panggil_antrian = $query->where('jenis_poli', 'Reguler')->latest('id')->paginate(1000);

        return view('reg.panggil_antrian', compact('dokter', 'panggil_antrian'));
    }

    public function savepanggilReg(Request $request, $id)
    {
        $panggil = AntrianPoliklinik::where(['id' => $id])->first();
        $panggil->status_panggil = 'Dipanggil';
        $panggil->save();

        ServerCreated::dispatch();

        return redirect('/reg/panggil')->with('success', 'Antrian dipanggil');
    }

    public function savependingReg(Request $request, $id)
    {
        $pending = AntrianPoliklinik::where(['id' => $id])->first();
        $pending->status_panggil = 'Dipending';
        $pending->save();

        ServerCreated::dispatch();

        return redirect('/reg/panggil')->with('success', 'Antrian dipending');
    }

    public function saveselesaiReg(Request $request, $id)
    {
        $selesai = AntrianPoliklinik::where(['id' => $id])->first();
        $selesai->status_panggil = 'Selesai';
        $selesai->save();

        ServerCreated::dispatch();

        return redirect('/reg/panggil')->with('success', 'Antrian selesai');
    }

    public function displayReg(Request $request)
    {
        $display = AntrianPoliklinik::whereDate('created_at', date('Y-m-d'))
        ->orderBy('status_panggil', 'asc')->get();

        if ($request->expectsJson()) {
            return response()->json(['data' => $display], 200);
        }

        return view('reg.display_antrian')->with('display', $display);
    }
}
