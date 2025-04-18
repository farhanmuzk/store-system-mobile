<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Negotiation;
use Illuminate\Support\Facades\Auth;

class NegotiationController extends Controller
{
    public function index()
    {
        $negotiation = Negotiation::where('user_id', Auth::id())->first();
        return view('pages.negotiation.index', compact('negotiation'));
    }

    public function store(Request $request)
    {
        $request->validate(['contact' => 'required|string|max:255']);

        $negotiation = Negotiation::updateOrCreate(
            ['user_id' => Auth::id()],
            ['contact' => $request->contact]
        );

        return redirect()->route('negotiation.verification')->with('success', 'Negotiation updated successfully.');
    }
    public function verification()
    {
        $negotiation = Negotiation::where('user_id', Auth::id())->first();
        return view('pages.negotiation.negotiation_verification', compact('negotiation'));
    }


}
