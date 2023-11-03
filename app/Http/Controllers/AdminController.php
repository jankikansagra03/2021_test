<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Registration;

class AdminController extends Controller
{
    //
    public function admin_dashboard()
    {

        $user_count = Registration::count();
        $event_count = Events::count();
        $active_count = Registration::where('status', 'Active')->count();
        $inactive_count = Registration::where('status', 'Inactive')->count();
        $deleted_count = Registration::where('status', 'Deleted')->count();
        $data = [
            'user_count' => $user_count,
            'event_count' => $event_count,
            'active_count' => $active_count,
            'inactive_count' => $inactive_count,
            'deleted_count' => $deleted_count
        ];
        return view('admin_dashboard', compact('data'));
    }
}
