<?php

namespace App\Http\Controllers;

use App\Models\AksesMember;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin == false) {
            if (!AksesMember::where('email', auth()->user()->email)->whereDay('created_at', date('d'))->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->exists()) {
                AksesMember::create([
                    'email' => auth()->user()->email,
                ]);
            }
        }
        return view('dashboard.home');
    }
}
