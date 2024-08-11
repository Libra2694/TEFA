<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\LaporanKemajuan;
use App\Models\LaporanAkhir;
use App\Models\LogBook;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $data['total_proposal'] = Proposal::count();
            $data['total_laporan_kemajuan'] = LaporanKemajuan::count();
            $data['total_laporan_akhir'] = LaporanAkhir::count();
            $data['total_logbook'] = LogBook::count();
            $data['latest_proposal'] = Proposal::with('user')->latest()->take(5)->get();
            $data['latest_laporan_kemajuan'] = LaporanKemajuan::with('user')->latest()->take(5)->get();
            $data['latest_laporan_akhir'] = LaporanAkhir::with('user')->latest()->take(5)->get();
        }
        else
        {
            $data['total_proposal'] = Proposal::where('user_id', auth()->user()->id)->count();
            $data['total_laporan_kemajuan'] = LaporanKemajuan::where('user_id', auth()->user()->id)->count();
            $data['total_laporan_akhir'] = LaporanAkhir::where('user_id', auth()->user()->id)->count();
            $data['total_logbook'] = LogBook::where('user_id', auth()->user()->id)->count();
            $data['latest_proposal'] = Proposal::with('user')->where('user_id', auth()->user()->id)->latest()->take(5)->get();
            $data['latest_laporan_kemajuan'] = LaporanKemajuan::with('user')->where('user_id', auth()->user()->id)->latest()->take(5)->get();
            $data['latest_laporan_akhir'] = LaporanAkhir::with('user')->where('user_id', auth()->user()->id)->latest()->take(5)->get();
        }
        return view('Home', $data);
    }
}
