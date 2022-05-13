<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use App\Models\Payment;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InsightsController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $today = today()->toDateString();
        $tomorrow = today()->addDay()->toDateString();
        $startOfMonth = today()->startOfMonth()->toDateString();
        $endOfMonth = today()->endOfMonth()->toDateString();
        
        $totalUsers = 
            User::where('is_blocked','=','false')
                ->where('is_admin','=','false')
                ->count();
        $todayUsers = 
            User::where('is_blocked','=','false')
                ->where('is_admin','=','false')
                ->whereDate('created_at', '>=', $today)
                ->whereDate('created_at','<',$tomorrow)
                ->count();
        $monthUsers = 
            User::where('is_blocked','=','false')
                ->where('is_admin','=','false')
                ->whereDate('created_at', '>=', $startOfMonth)
                ->whereDate('created_at', '<', $endOfMonth)
                ->count();

        $totalPayments = 
            Payment::where('is_pending','=','false')
                ->sum('price');
        $todayPayments = 
            Payment::where('is_pending','=','false')
                ->whereDate('datetime', '>=', $today)
                ->whereDate('datetime', '<', $tomorrow)
                ->sum('price');
        $monthPayments = 
            Payment::where('is_pending','=','false')
                ->whereDate('datetime', '>=', $startOfMonth)
                ->whereDate('datetime', '<', $endOfMonth)
                ->sum('price');

        $totalTournaments = 
            Tournament::where('is_approved','=','true')
                ->count();
        $todayTournaments = 
            Tournament::where('is_approved','=','true')
                ->whereDate('date', '>=', $today)
                ->whereDate('date', '<', $tomorrow)
                ->count();
        $monthTournaments = 
            Tournament::where('is_approved','=','true')
                ->whereDate('date', '>=', $startOfMonth)
                ->whereDate('date', '<=', $endOfMonth)
                ->count();

        $totalAds = 
            Ad::query()
                ->where('begin_at','>=',$today)
                ->sum('price');

        return new Response([
            'total' => [
                'users' => $totalUsers,
                'payments' => $totalPayments,
                'tournaments' => $totalTournaments,
                'ads' => $totalAds,
            ],
            'today' => [
                'users' => $todayUsers,
                'payments' => $todayPayments,
                'tournaments' => $todayTournaments,
            ],
            'month' => [
                'users' => $monthUsers,
                'payments' => $monthPayments,
                'tournaments' => $monthTournaments,
            ]
        ]);
    }
}
