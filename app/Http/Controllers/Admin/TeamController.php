<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
{
    public function top()
    {
        $teams = [
            'Manchester United', 'Liverpool', 'Chelsea', 'Arsenal', 'Tottenham Hotspur',
            'Manchester City', 'Leicester City', 'Everton', 'West Ham United', 'Aston Villa',
            'Newcastle United', 'Southampton', 'Wolverhampton Wanderers', 'Brighton & Hove Albion',
            'Burnley', 'Crystal Palace', 'Leeds United', 'Norwich City', 'Watford', 'Brentford'
        ];

        return Inertia::render('Index', ['teams' => $teams]);
    }

    public function index()
    {
        $teams = Team::orderBy('category', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->groupBy('category_jp');

        return Inertia::render('Admin/Teams/Index', [
            'groupedTeams' => $teams
        ]);
    }

    // 新規作成画面
    public function create()
    {
        return Inertia::render('Admin/Teams/Create');
    }

    // チーム登録
    public function store(TeamRequest $request)
    {
        Team::create($request->validated());
        return redirect()->route('admin.teams.index')->with('success', 'Team created successfully.');
    }

    // 編集画面
    public function edit(Team $team)
    {
        return Inertia::render('Admin/Teams/Edit', [
            'team' => $team,
        ]);
    }

    // チーム更新
    public function update(TeamRequest $request, Team $team)
    {
        $team->update($request->validated());
        return redirect()->route('admin.teams.index')->with('success', 'Team updated successfully.');
    }

    // チーム削除
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('admin.teams.index')->with('success', 'Team deleted successfully.');
    }
}
