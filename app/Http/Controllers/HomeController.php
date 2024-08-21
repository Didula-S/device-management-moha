<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $expiringDevices = Device::whereDate('warranty_expiration_date', '<=', Carbon::now()->addDays(30))
            ->orderBy('warranty_expiration_date')
            ->get();

        return view('home', compact('expiringDevices'));
    }
}