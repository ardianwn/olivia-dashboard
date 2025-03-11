<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;


class NotificationController extends Controller
{
    // Mengirim notifikasi atau pengumuman
    public function sendNotification(Request $request)
    {
        $users = User::where('role', 'ketua_tim')->get();
        foreach ($users as $user) {
            // Mengirim email atau notifikasi
            // Contoh mengirim email
            Mail::to($user->email)->send(new NotificationMail($request->message));
        }
        return redirect()->back()->with('success', 'Notifikasi berhasil dikirim');
    }
}
