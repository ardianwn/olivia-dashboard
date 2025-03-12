<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000', // Validasi input
        ]);

        $users = User::where('role', 'ketua_tim')->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new NotificationMail($request->message)); // Kirim string, bukan objek
        }

        return redirect()->back()->with('success', 'Notifikasi berhasil dikirim.');
    }
}
