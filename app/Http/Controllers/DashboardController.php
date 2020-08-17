<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Dashboard - Analytics
    public function dashboardAnalytics(){
        return redirect("/pre_filter");
    }
}

