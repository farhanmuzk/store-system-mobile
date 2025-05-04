<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneySupply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MoneySupplyController extends Controller
{
    public function index()
{
    // Fetch the most recent money supply for the logged-in user
    $data = MoneySupply::where('user_id', Auth::id())->latest()->get();
    return view('pages.excuting.paying_page.money_supply', compact('data'));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_id' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'tanggal' => 'required|date',
            'payment_method' => 'required|string',
            'nomor_tf' => 'nullable|string|max:100',
            'note' => 'nullable|string',
        ]);

        // Simpan data ke dalam tabel money_suplies
        MoneySupply::create([
            'user_id' => Auth::id(),
            'nama_id' => $validated['nama_id'],
            'no_telp' => $validated['no_telp'],
            'tanggal' => $validated['tanggal'],
            'payment_method' => $validated['payment_method'],
            'nomor_tf' => $request->input('nomor_tf'),
            'note' => $request->input('note'),
            'message_admin' => null,
            'image_payment' => null,
            'image_feedback' => null,
            'type_payment' => 'pending', // default enum
        ]);
            return redirect()->back()->with('success', 'Data money supply berhasil dikirim!');
        }

        public function updateMoneySupply(Request $request, $id)
        {
            $validated = $request->validate([
                'message_admin' => 'nullable|string',
                'image_payment' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'type_payment' => 'nullable|string',
                'image_feedback' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $moneySupply = MoneySupply::where('user_id', Auth::id())->where('id', $id)->first();

            if (!$moneySupply) {
                return redirect()->back()->with('error', 'Data tidak ditemukan!');
            }

            if ($request->hasFile('image_payment')) {
                $imagePath = $request->file('image_payment')->store('payment_images', 'public');
                $moneySupply->image_payment = $imagePath;
            }

            if ($request->hasFile('image_feedback')) {
                $feedbackPath = $request->file('image_feedback')->store('feedback_images', 'public');
                $moneySupply->image_feedback = $feedbackPath;
            }

            $moneySupply->message_admin = $request->input('message_admin');
            $moneySupply->type_payment = 'completed';
            $moneySupply->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui!');
        }


        public function monitoringPage()
        {
            // Ambil semua data money supply milik user yang sedang login
            $data = MoneySupply::where('user_id', Auth::id())->latest()->get();

            return view('pages.excuting.monitoring_page.money_supply_notification', compact('data'));
        }

public function updateFromMonitoring(Request $request)
{
    $validated = $request->validate([
        'message_admin' => 'nullable|string',
        'image_payment' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'type_payment' => 'nullable|string', // Kita ubah menjadi nullable, karena akan diproses menjadi 'processing'
        'image_feedback' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $moneySupply = MoneySupply::where('user_id', Auth::id())->latest()->first();

    if (!$moneySupply) {
        return redirect()->back()->with('error', 'Data tidak ditemukan!');
    }

    // Simpan gambar bukti pembayaran jika ada
    if ($request->hasFile('image_payment')) {
        $imagePath = $request->file('image_payment')->store('payment_images', 'public');
        $moneySupply->image_payment = $imagePath;
    }

    // Simpan message admin jika ada
    $moneySupply->message_admin = $request->input('message_admin');

    // Set type_payment menjadi 'processing'
    $moneySupply->type_payment = 'processing'; // Atau 'processing' sesuai dengan kebutuhan

    // Simpan feedback jika ada
    if ($request->hasFile('image_feedback')) {
        $feedbackPath = $request->file('image_feedback')->store('feedback_images', 'public');
        $moneySupply->image_feedback = $feedbackPath;
    }

    $moneySupply->save();

    return redirect()->back()->with('success', 'Data berhasil diperbarui!');
}


}
