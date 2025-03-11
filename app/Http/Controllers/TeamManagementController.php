<?php

namespace App\Http\Controllers;

use App\Models\TimLomba;
use Illuminate\Http\Request;

class TeamManagementController extends Controller
{
    // Menampilkan daftar tim yang terdaftar
    public function index()
    {
        $timLomba = TimLomba::with('anggota')->get();
        return view('team-management.index', compact('timLomba'));
    }

    // Menampilkan detail tim
    public function show($id)
    {
        $tim = TimLomba::with(['anggota', 'berkas', 'pembayaran'])->findOrFail($id);
        return view('team-management.show', compact('tim'));
    }

    // Menampilkan form edit data tim
    public function edit($id)
    {
        $tim = TimLomba::findOrFail($id);
        return view('team-management.edit', compact('tim'));
    }

    // Proses update data tim
    public function update(Request $request, $id)
    {
        $tim = TimLomba::findOrFail($id);
        $tim->update($request->all());
        return redirect()->route('team-management.index')->with('success', 'Data tim berhasil diperbarui');
    }

    // Menghapus data tim
    public function destroy($id)
    {
        $tim = TimLomba::findOrFail($id);
        $tim->delete();
        return redirect()->route('team-management.index')->with('success', 'Tim berhasil dihapus');
    }

    // Mengecek status pendaftaran tim
    public function checkStatus($id)
    {
        $tim = TimLomba::with(['berkas', 'pembayaran'])->findOrFail($id);
        return view('team-management.status', compact('tim'));
    }
}
