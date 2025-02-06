<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::orderBy('id', 'asc')->get();

        return view('home', compact('campaigns'));
    }

    public function kegiatan()
    {
        $campaigns = Campaign::orderBy('id', 'asc')->get();

        return view('kegiatan', compact('campaigns'));
    }

    public function detail($slug)
    {
        $campaign = Campaign::where('slug', $slug)->first();
        return view('detail', compact('campaign'));
    }
}
