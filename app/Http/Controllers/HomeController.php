<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\RoomSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = User::count();
        $roomSizeCount = RoomSize::count();
        $pendingRequestsCount = Booking::where('status', 'pending')->count();
        $totalRevenue = Booking::where('status', 'verified')->sum('total_price');
    
        return view('home', compact('userCount', 'roomSizeCount', 'pendingRequestsCount', 'totalRevenue'));
    }
    

    public function userhome(){
        
        return view('client.home');
    }
    public function history(){
        $bookings = Booking::where('user_id', Auth::id())
        ->where('status', Booking::STATUS_VERIFIED)
        ->get();
    return view('client.history', compact('bookings'));

    }
}
