<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetilPeserta;
use App\Models\TimLomba;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\KategoriLomba;

class DetilPesertaController extends Controller
{
    public function index()
    {
        $tim = TimLomba::where('id_ketua', Auth::id())->first();
        if (!$tim) {
            return redirect()->route('tim.index')->with('error', 'Tim tidak ditemukan.');
        }
        $t = TimLomba::where('id_ketua', Auth::id())->first(); // Ambil satu objek, bukan Collection

        if ($t && $t->status_final_submit == 1) {
            return redirect()->route('ketua.dashboard')->with('success', 'Silakan menunggu pengumuman');
        }
       // Ambil jumlah anggota dalam tim yang sesuai dengan id_tim
$data = DetilPeserta::where('id_tim', $tim->id)->count();

// Ambil data anggota tim
$anggota = DetilPeserta::where('id_tim', $tim->id)->get();

// Ambil jumlah maksimal anggota sesuai dengan kategori lomba tim ini
$max = KategoriLomba::where('id', $tim->kategori_id)->value('jumlah_anggota_maksimal');
        return view('anggota.index', compact('anggota', 'tim', 'data', 'max'));
    }

    public function create()
    {
        $tim = TimLomba::where('id_ketua', Auth::id())->first();
        $data = DetilPeserta::where('id_tim', $tim->id)->count();
        if (!$tim) {
            return redirect()->route('anggota.index')->with('error', 'Anda belum memiliki tim.');
        }

        return view('anggota.create', compact('tim', 'data'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nim' => 'required|string|max:255|unique:detil_peserta,nim',
            'nama_lengkap' => 'required|string|max:255',
            'scan_ktm' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'no_wa' => 'required|string|max:15',
            'foto_anggota' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        

        // Cek apakah user memiliki tim
        $tim = TimLomba::where('id_ketua', Auth::id())->first();
        if (!$tim) {
            return redirect()->route('anggota.index')->with('error', 'Anda belum memiliki tim.');
        }

        // Simpan data
        $data = [
            'nim' => $request->nim,
            'nama_lengkap' => $request->nama_lengkap,
            'id_tim' => $tim->id,
            'no_wa' => $request->no_wa,
            'status_verifikasi' => 'pending',
        ];

        // Upload Scan KTM
        if ($request->hasFile('scan_ktm')) {
            $data['scan_ktm'] = $request->file('scan_ktm')->store('ktm', 'public');
        }

        // Upload Foto Anggota
        if ($request->hasFile('foto_anggota')) {
            $data['foto_anggota'] = $request->file('foto_anggota')->store('anggota', 'public');
        }

        DetilPeserta::create($data);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $anggota = DetilPeserta::findOrFail($id);
        $tim = TimLomba::where('id_ketua', Auth::id())->first();

        if (!$tim || $anggota->id_tim !== $tim->id) {
            return redirect()->route('anggota.index')->with('error', 'Anda tidak memiliki akses.');
        }

        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $anggota = DetilPeserta::findOrFail($id);
        $tim = TimLomba::where('id_ketua', Auth::id())->first();

        if (!$tim || $anggota->id_tim !== $tim->id) {
            return redirect()->route('anggota.index')->with('error', 'Anda tidak memiliki akses.');
        }

        // Validasi input
        $request->validate([
            'nim' => 'required|string|max:255|unique:detil_peserta,nim,' . $anggota->id,
            'nama_lengkap' => 'required|string|max:255',
            'scan_ktm' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'no_wa' => 'required|string|max:15',
            'foto_anggota' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $anggota->nim = $request->nim;
        $anggota->nama_lengkap = $request->nama_lengkap;
        $anggota->no_wa = $request->no_wa;

        // Update Scan KTM jika ada file baru
        if ($request->hasFile('scan_ktm')) {
            if ($anggota->scan_ktm) {
                Storage::disk('public')->delete($anggota->scan_ktm);
            }
            $anggota->scan_ktm = $request->file('scan_ktm')->store('ktm', 'public');
        }

        // Update Foto Anggota jika ada file baru
        if ($request->hasFile('foto_anggota')) {
            if ($anggota->foto_anggota) {
                Storage::disk('public')->delete($anggota->foto_anggota);
            }
            $anggota->foto_anggota = $request->file('foto_anggota')->store('anggota', 'public');
        }

        $anggota->save();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $anggota = DetilPeserta::findOrFail($id);
        $tim = TimLomba::where('id_ketua', Auth::id())->first();

        if (!$tim || $anggota->id_tim !== $tim->id) {
            return redirect()->route('anggota.index')->with('error', 'Anda tidak memiliki akses.');
        }

        // Hapus file yang tersimpan
        if ($anggota->scan_ktm) {
            Storage::disk('public')->delete($anggota->scan_ktm);
        }
        if ($anggota->foto_anggota) {
            Storage::disk('public')->delete($anggota->foto_anggota);
        }

        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus!');
    }

    public function showKtm($id)
    {
        $anggota = DetilPeserta::findOrFail($id);
        
        if (!$anggota->ktm) {
            return redirect()->back()->with('error', 'KTM tidak ditemukan.');
        }

        return response()->file(storage_path("app/public/{$anggota->ktm}"));
    }

}
