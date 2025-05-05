<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\IncomingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('type', '!=', 'notification_order')
            ->whereIn('status', ['approved', 'rejected', 'pending'])
            ->get();

        return view('notification', compact('notifications'));
    }

    public function payingMember()
    {
        $notifications = Notification::where('type', 'notification')
            ->whereIn('status', ['pending'])
            ->get();

        return view('pages.excuting.paying_page.paying_member', compact('notifications'));

    }

    public function orderApproval()
    {
        $notifications = Notification::where('type', 'notification_order')->get();

        if (request()->routeIs('gallery-order')) {
            return view('pages.excuting.ordering_page.gallery_order', compact('notifications'));
        }

        return view('pages.excuting.ordering_page.order_notification', compact('notifications'));
    }

    public function updatePlus(Request $request, Notification $notification)
    {
        $request->validate([
            'noted_plus' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image')
            ? $request->file('image')->store('noted_plus_images', 'public')
            : $notification->image;

        $notification->update([
            'noted_plus' => $request->input('noted_plus'),
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Noted Plus berhasil disimpan.');
    }

    public function rejectApproval(Request $request, Notification $notification)
    {
        $request->validate([
            'noted' => 'required|string',
        ]);

        $notification->update([
            'status' => 'rejected',
            'noted' => $request->input('noted'),
        ]);

        return back()->with('success', 'Notification rejected.');
    }

    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'text' => 'nullable|string|max:255',
        ]);

        $imagePath = $request->file('image')
            ? $request->file('image')->store('notifications', 'public')
            : null;

        Notification::create([
            'token' => Str::uuid(),
            'notification_time' => now(),
            'image' => $imagePath,
            'text' => $request->input('text'),
            'status' => 'pending',
        ]);

        return redirect()->route('notifications.index');
    }

    // ✅ Update untuk Notifikasi Tipe Order
    public function updateOrder(Request $request, IncomingOrder $order)
    {
        $validated = $this->validateOrder($request);

        $order->update($validated);

        $existingNotification = Notification::where('type', 'notification_order')
            ->where('incoming_order_id', $order->id)
            ->where('status', 'rejected')
            ->first();

        $notedText = collect($validated)->map(fn($v, $k) => ucfirst(str_replace('_', ' ', $k)) . ": $v")->implode(', ');

        if ($existingNotification) {
            $existingNotification->update([
                'status' => 'pending',
                'noted' => $notedText,
                'notification_time' => now(),
            ]);
        } else {
            Notification::create([
                'token' => Str::uuid(),
                'notification_time' => now(),
                'user_id' => Auth::id(),
                'type' => 'notification_order',
                'status' => 'pending',
                'image' => null,
                'noted' => $notedText,
                'incoming_order_id' => $order->id,
            ]);
        }

        return redirect()->back()->with('success', 'Incoming order has been updated.');
    }

    // Tambahan validasi untuk order
    protected function validateOrder(Request $request)
    {
        return $request->validate([
            'order_number' => 'required|string|max:50',
            'customer_name' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            // tambahkan validasi lain sesuai struktur order kamu
        ]);
    }

    public function riwayat(Request $request)
    {
        // Ambil status filter dari query parameter (default: 'pending')
        $status = $request->get('status', 'pending');

        // Ambil notifikasi berdasarkan status
        $notifications = Notification::where('type', 'notification')
            ->where('status', $status)
            ->get();

        return view('pages.excuting.paying_page.riwayat_page', compact('notifications'));
    }


    public function approve(Notification $notification)
    {
        $notification->update(['status' => 'approved']);
        return back()->with('success', 'Notification approved successfully.');
    }

    public function reject(Notification $notification)
    {
        $notification->update(['status' => 'rejected']);
        return back()->with('success', 'Notification rejected.');
    }
}
