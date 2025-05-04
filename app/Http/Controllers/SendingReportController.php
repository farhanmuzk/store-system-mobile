<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SendingReport;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class SendingReportController extends Controller
{
    public function index()
    {
        // Ambil semua report dengan type_report = 'ordering' milik user saat ini
        $reports = SendingReport::where('user_id', Auth::id())
                    ->where('type_report', 'ordering')
                    ->latest()
                    ->get();

        return view('pages.excuting.ordering_page.send_report', compact('reports'));
    }

    public function index_paying()
    {
        // Ambil semua report dengan type_report = 'ordering' milik user saat ini
        $reports = SendingReport::where('user_id', Auth::id())
                    ->where('type_report', 'paying')
                    ->latest()
                    ->get();

        return view('pages.excuting.paying_page.send_paying_report', compact('reports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048', // hanya gambar dan max 2MB
            'teks' => 'nullable|string',
            'type_report' => 'required|in:ordering,paying',
        ]);

        $path = $request->file('file')->store('reports', 'public');

        SendingReport::create([
            'file' => $path,
            'teks' => '',
            'user_id' => Auth::id(),
            'type_report' => $request->input('type_report'),
        ]);

        return back()->with('success', 'Report has been sent!');
    }

    public function store_paying(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048', // hanya gambar dan max 2MB
            'teks' => 'nullable|string',
            'type_report' => 'required|in:ordering,paying',
        ]);

        $path = $request->file('file')->store('reports', 'public');

        SendingReport::create([
            'file' => $path,
            'teks' => '',
            'user_id' => Auth::id(),
            'type_report' => $request->input('type_report'),
        ]);

        return back()->with('success', 'Report has been sent!');
    }

    public function orderingReport()
    {
        $reports = SendingReport::where('type_report', 'ordering')->get();

        foreach ($reports as $report) {
            $created = Carbon::parse($report->created_at);

            if ($created->isToday()) {
                $report->label = 'Hari Ini - Admin (' . $report->user->name . ')'; // Ambil nama admin
            } elseif ($created->greaterThanOrEqualTo(now()->subWeek())) {
                $report->label = 'Minggu Lalu - Admin (' . $report->user->name . ')';
            } else {
                $report->label = $created->translatedFormat('d F Y') . ' - Admin (' . $report->user->name . ')';
            }
        }

        return view('pages.excuting.monitoring_page.ordering_report', compact('reports'));
    }

    public function payingReport()
    {
        $reports = SendingReport::where('type_report', 'paying')->get();

        foreach ($reports as $report) {
            $created = Carbon::parse($report->created_at);

            if ($created->isToday()) {
                $report->label = 'Hari Ini - Admin (' . $report->user->name . ')'; // Ambil nama admin
            } elseif ($created->greaterThanOrEqualTo(now()->subWeek())) {
                $report->label = 'Minggu Lalu - Admin (' . $report->user->name . ')';
            } else {
                $report->label = $created->translatedFormat('d F Y') . ' - Admin (' . $report->user->name . ')';
            }
        }

        return view('pages.excuting.monitoring_page.paying_report', compact('reports'));
    }



    public function updateTeks(Request $request)
    {
        $request->validate([
            'report_id' => 'required|exists:sending_reports,id',
            'teks' => 'nullable|string|max:1000',
        ]);

        $report = SendingReport::where('id', $request->report_id)
            ->where('user_id', Auth::id())
            ->where('type_report', 'ordering')
            ->firstOrFail();

        $report->teks = $request->teks;
        $report->save();

        return back()->with('success', 'Pesan berhasil diperbarui.');
    }

    public function updateTeks_paying(Request $request)
    {
        $request->validate([
            'report_id' => 'required|exists:sending_reports,id',
            'teks' => 'nullable|string|max:1000',
        ]);

        $report = SendingReport::where('id', $request->report_id)
            ->where('user_id', Auth::id())
            ->where('type_report', 'paying')
            ->firstOrFail();

        $report->teks = $request->teks;
        $report->save();

        return back()->with('success', 'Pesan berhasil diperbarui.');
    }

}
