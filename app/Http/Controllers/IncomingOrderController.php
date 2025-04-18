<?php

namespace App\Http\Controllers;

use App\Models\IncomingOrder;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class IncomingOrderController extends Controller
{
    public function index()
    {
        $notification = Notification::where('user_id', Auth::id())
            ->latest()
            ->first();

        $incomingOrder = null;

        if ($notification && $notification->status === 'rejected') {
           // Tambahkan kolom 'incoming_order_id' di tabel 'notifications' kalau belum
$incomingOrder = IncomingOrder::where('id', $notification->incoming_order_id)->first();

        }

        return view('pages.negotiation.incoming_order_page.index', compact('notification', 'incomingOrder'));
    }

    public function getNotifications()
    {
        $notifications = Notification::where('type', 'notification_order')->get();

        if (request()->routeIs('incoming-notification')) {
            return view('pages.negotiation.incoming_order_page.notification_incoming', compact('notifications'));
        }

        return view('pages.negotiation.incoming_order_page.history_notification', compact('notifications'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateOrder($request);

        $order = IncomingOrder::create(array_merge($validated, [
            'user_id' => Auth::id(),
        ]));

        Notification::create([
            'token' => Str::uuid(),
            'notification_time' => now(),
            'user_id' => Auth::id(),
            'type' => 'notification_order',
            'status' => 'pending',
            'image' => null,
            'noted' => collect($validated)->map(fn($v, $k) => ucfirst(str_replace('_', ' ', $k)) . ": $v")->implode(', '),
            'incoming_order_id' => $order->id,
        ]);

        return redirect()->back()->with('success', 'Incoming order has been submitted.');
    }

    public function edit(IncomingOrder $order)
{
    $notification = Notification::where('user_id', Auth::id())
        ->where('incoming_order_id', $order->id)
        ->latest()
        ->first();

    return view('pages.negotiation.incoming_order_page.index', compact('notification', 'order'));
}


    public function update(Request $request, IncomingOrder $order)
    {
        $validated = $this->validateOrder($request);
        $existingNotification = Notification::where('user_id', Auth::id())
        ->where('incoming_order_id', $order->id)
        ->where('status', 'rejected')
        ->latest()
        ->first();

    if ($existingNotification) {
        // Update hanya kolom 'noted', dan ubah status ke 'pending' kembali
        $existingNotification->update([
            'status' => 'pending',
            'noted' => collect($validated)->map(fn($v, $k) => ucfirst(str_replace('_', ' ', $k)) . ": $v")->implode(', '),
            'notification_time' => now(),
        ]);
    } else {
        Log::warning('No existing notification found for this order.');
    }


        return redirect()->back()->with('success', 'Incoming order has been updated.');
    }

    private function validateOrder(Request $request)
    {
        return $request->validate([
            'product'         => 'required|string',
            'quantity'        => 'required|integer|min:1',
            'customer_name'   => 'required|string',
            'address'         => 'required|string',
            'rt_rw'           => 'required|string',
            'district'        => 'required|string',
            'regency'         => 'required|string',
            'province'        => 'required|string',
            'phone_number'    => 'required|string',
            'payment_method'  => 'required|string',
            'nomor_tf'        => 'nullable|string',
            'total'           => 'required|numeric|min:0',
            'estimation'      => 'nullable|string',
            'note'            => 'nullable|string',
        ]);
    }
}
