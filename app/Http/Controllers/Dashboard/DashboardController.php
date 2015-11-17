<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function welcome()
    {
        return view('dashboard.welcome');
    }

}
