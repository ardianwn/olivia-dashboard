<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BerkasLomba;
use App\Models\TimLomba;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\PembayaranLomba;

class BerkasLombaController extends Controller
{
    public function index()
    {
        // Cari tim berdasarkan ID ketua yang sedang login
        $tim = TimLomba::where('id_ketua', Auth::id())->first();
    
        // Cek apakah tim sudah final submit
        if ($tim->status_final_submit == 1) {
            return redirect()->route('ketua.dashboard')->with('success', 'Silakan menunggu pengumuman');
        }
        // Jika tim tidak ditemukan, redirect ke halaman pembayaran
        if (!$tim) {
            return redirect()->route('pembayaran.index')->with('error', 'Tim tidak ditemukan.');
        }
    
        // Periksa apakah pembayaran telah dilakukan
        $pembayaran = PembayaranLomba::where('id_tim', $tim->id)->first();
        
       
        if ($pembayaran && $pembayaran->status_verifikasi == "valid") {
            // Ambil berkas yang terkait dengan tim dan pastikan data terbaru diambil
            $berkas = BerkasLomba::where('id_tim', $tim->id)
                        ->orderBy('updated_at', 'desc') // Ambil data terbaru
                        ->get();
            // Cek apakah ada berkas dengan status "pending"
           $isPending = $berkas->contains('status_verifikasi', 'pending');
           $data = BerkasLomba::where('id_tim', $tim->id)->first();
            return view('berkas.index', compact('berkas', 'tim', 'isPending','data'));
         
        } 
         elseif ($pembayaran) {
            return redirect()->route('pembayaran.index')->with('error', 'Menunggu Verifikasi Admin');
        } 
            else {
            return redirect()->route('pembayaran.index')->with('error', 'Lakukan pembayaran terlebih dahulu.');
        }
    }
    
    public function create()
    {
        $tim = TimLomba::where('id_ketua', Auth::id())->first();
        $data = BerkasLomba::where('id_tim', $tim->id)->first();
        if ($data && $data->status_verifikasi == "pending") {
            return redirect()->route('berkas.index')->with('error', 'Menunggu Verifikasi Admin');}

        return view('berkas.create', compact('tim'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengesahan' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'orisinalitas' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'biodata' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'form_pendaftaran' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'url_file' => 'nullable|string|url|max:2048', // Pastikan url_file hanya menerima URL, bukan file
        ]);

        $tim = TimLomba::where('id_ketua', Auth::id())->first();
        if (!$tim) {
            return redirect()->route('dashboard')->with('error', 'Tim tidak ditemukan.');
        }

        // Array untuk menyimpan path file
        $fileFields = ['pengesahan', 'orisinalitas', 'biodata', 'form_pendaftaran'];
        $filePaths = [];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $filePaths[$field] = $request->file($field)->store('berkas_lomba', 'public');
            } else {
                $filePaths[$field] = null;
            }
        }

        // Simpan data ke database
        BerkasLomba::create([
            'id_tim' => $tim->id,
            'pengesahan' => $filePaths['pengesahan'],
            'orisinalitas' => $filePaths['orisinalitas'],
            'biodata' => $filePaths['biodata'],
            'form_pendaftaran' => $filePaths['form_pendaftaran'],
            'url_file' => $request->input('url_file'), // Simpan URL langsung dari input
            'status_verifikasi' => 'pending',
        ]);
        

        return redirect()->route('berkas.index')->with('success', 'Berkas berhasil diunggah!');
    }

    public function edit( $id)
    {
        $berkas = BerkasLomba::findOrFail($id);
        return view('berkas.edit', compact('berkas'));
    }

    public function update(Request $request, BerkasLomba $berkas)
    {
        Log::info("Memulai update untuk Berkas ID: " . $berkas->id);
        Log::info("Metode request: " . $request->method());
    
        if ($request->method() !== 'PUT') {
            return redirect()->back()->with('error', 'Metode HTTP tidak valid.');
        }
    
        $request->validate([
            'pengesahan' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'url_file' => 'nullable|string|url|max:2048',
        ]);
    
        Log::info("Validasi selesai.");
    
        $updateData = [];
    
        if ($request->hasFile('pengesahan')) {
            if ($berkas->pengesahan) {
                Storage::delete('public/' . $berkas->pengesahan);
            }
            $path = $request->file('pengesahan')->store('berkas_lomba', 'public');
            $updateData['pengesahan'] = $path;
        }
    
        if ($request->filled('url_file')) {
            $updateData['url_file'] = $request->input('url_file');
        }
    
        $updateData['status_verifikasi'] = 'pending';
    
        if (!empty($updateData)) {
            $berkas->update($updateData);
            Log::info("Update sukses!");
        } else {
            Log::info("Tidak ada perubahan data.");
        }
    
        return redirect()->route('berkas.index')->with('success', 'Berkas diperbarui.');
    }
    

    public function destroy(BerkasLomba $berkas)
    {
        Storage::delete('public/' . $berkas->url_file);
        $berkas->delete();

        return redirect()->route('berkas.index')->with('success', 'Berkas dihapus!');
    }
}
