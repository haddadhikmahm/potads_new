<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users_count' => \App\Models\User::count(),
            'events_count' => \App\Models\Event::count(),
            'articles_count' => \App\Models\Article::count(),
            'donations_total' => \App\Models\Donation::where('payment_status', 'success')->sum('amount'),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
