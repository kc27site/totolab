<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
{
    public function index()
    {
        $teams = [
            'Manchester United', 'Liverpool', 'Chelsea', 'Arsenal', 'Tottenham Hotspur',
            'Manchester City', 'Leicester City', 'Everton', 'West Ham United', 'Aston Villa',
            'Newcastle United', 'Southampton', 'Wolverhampton Wanderers', 'Brighton & Hove Albion',
            'Burnley', 'Crystal Palace', 'Leeds United', 'Norwich City', 'Watford', 'Brentford'
        ];

        return Inertia::render('Index', ['teams' => $teams]);
    }
}
