<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'orderCount' => Order::count(),
            'projectCount' => Project::count(),
            'userCounts' => [
                'admin' => User::role('admin')->count(),
                'designer' => User::role('designer')->count(),
                'fotografer' => User::role('fotografer')->count(),
                'socialMedia' => User::role('social-media')->count(),
            ]
        ]);
    }
}
