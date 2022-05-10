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

        $today = today()->format('Y-m-d');
        $startOfMonth = today()->startOfMonth()->format('Y-m-d');

        $users = User::query()->where('is_blocked','=','false');
        
        $totalUsers = $users->count();
        $todayUsers = $users->whereDate('created_at', '>=', $today)->count();
        $monthUsers = $users->whereDate('created_at', '>=', $startOfMonth)->count();

        $payments = Payment::query()->where('is_pending','=','false');

        $totalPayments = $payments->sum('price');
        $todayPayments = $payments->whereDate('datetime', '>=', $today)->sum('price');
        $monthPayments = $payments->whereDate('datetime', '>=', $startOfMonth)->sum('price');

        $tournaments = Tournament::query()->where('is_approved','=','true');

        $totalTournaments = $tournaments->count();
        $todayTournaments = $tournaments->whereDate('date', '>=', $today)->count();
        $monthTournaments = $tournaments->whereDate('date', '>=', $startOfMonth)->count();

        $totalAds = Ad::query()->where('end_at','<=',$today)->sum('price');

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
