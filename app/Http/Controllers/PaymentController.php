<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Notification;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('gambar')->store('payments', 'public');

        // Simpan pembayaran dengan status awal "processing"
        $payment = Payment::create([
            'user_id' => Auth::id(),
            'image' => $imagePath,
            'status' => 'processing',
        ]);

        // Buat notifikasi baru terkait pembayaran
        Notification::create([
            'token' => Str::uuid(),
            'notification_time' => now(),
            'user_id' => Auth::id(),
            'image' => $imagePath,
            'type' => 'notification',
            'status' => 'pending', // status awal yang benar
            'noted' => 'Payment waiting for approval',
        ]);

        return redirect()->route('pages.marketing.payment_page.payment_choice', ['id' => $payment->id])->with('success', 'Bukti pembayaran berhasil diunggah! Menunggu persetujuan admin.');
    }

    public function updatePayment(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'transfer_payment' => 'nullable|string|max:255',
        ]);

        if ($request->has('generate_cash_code')) {
            $cashCode = Str::upper(Str::random(5));
            $payment->cash_code = $cashCode;
            $notificationNote = "Cash Code Generated: $cashCode";
        } else {
            $payment->transfer_payment = $request->transfer_payment;
            $notificationNote = "Transfer Payment Received: " . $request->transfer_payment;
        }

        $payment->status = 'processing';
        $payment->save();

        Notification::create([
            'token' => Str::uuid(),
            'notification_time' => now(),
            'user_id' => Auth::id(),
            'image' => $payment->image,
            'type' => 'notification',
            'status' => 'pending',
            'noted' => $notificationNote,
        ]);

        // Cek notifikasi terkait untuk validasi status
        $existingNotification = Notification::where('image', $payment->image)->first();

        if ($existingNotification && $existingNotification->status === 'approved') {
            $payment->status = 'completed';
            $payment->save();
        }

        return view('pages.marketing.payment_page.payment_choice', compact('payment'));
    }

    public function showChoice($id)
    {
        $payment = Payment::findOrFail($id);

        $notification = Notification::where('image', $payment->image)->first();

        if (!$notification || $notification->status !== 'approved') {
            return redirect()->route('dashboard')->with('error', 'Pembayaran belum disetujui oleh admin.');
        }

        return view('pages.marketing.payment_page.payment_choice', compact('payment'));
    }

    public function editGetData($id)
    {
        $payment = Payment::findOrFail($id);

        return view('pages.marketing.payment_page.payment_choice', compact('payment'));
    }
}
