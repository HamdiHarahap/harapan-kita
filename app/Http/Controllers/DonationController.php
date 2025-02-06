<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Donator;
use App\Models\Payment;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tujuan' => 'required',
            'nama' => 'required',
            'email' => 'email',
            'phone' => 'numeric',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048', 
            'jumlah' => 'required|numeric'
        ], [
            'tujuan.required' => 'Donasi tujuan wajib diisi',
            'nama.required' => 'Nama tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'phone.numeric' => 'Nomor Telepon harus angka',
            'bukti.required' => 'Bukti tidak boleh kosong',
            'jumlah.required' => 'Jumlah tidak boleh kosong',
            'jumlah.numeric' => 'Jumlah harus berupa angka'
        ]);

        $donator = Donator::create([
            'name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $campaign = Campaign::where('judul', $request->tujuan)->first();

        if ($campaign) {
            $campaign->dana_terkumpul += $request->jumlah;
            $campaign->save();
        }

        $donation = Donation::create([
            'donator_id' => $donator->id,
            'campaign_id' => $campaign ? $campaign->id : null,
            'pesan' => $request->pesan,
            'jumlah_donasi' => $request->jumlah
        ]);

        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_pembayaran', 'public');
        } else {
            $buktiPath = null;
        }

        Payment::create([
            'donation_id' => $donation->id,
            'bukti_transfer' => $buktiPath
        ]);

        return redirect()->back()->with('success', 'Donasi berhasil dikirim!');
    }
}
