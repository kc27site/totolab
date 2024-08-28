<?php

namespace App\Http\Controllers\Admin;

use DiDom\Document;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Team;
use App\Models\Game;
use App\Http\Requests\ScheduleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::orderBy('created_at', 'desc')->orderBy('type')->get();
        foreach ($schedules as &$schedule) {
            $schedule->type_jp = $schedule->type_jp;
        }
        return Inertia::render('Admin/Schedules/Index', [
            'schedules' => $schedules
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Schedules/Create');
    }

    public function store(ScheduleRequest $request)
    {
        DB::beginTransaction();

        try {
            $startDate = $request->start_date;
            $endDate = $request->end_date ?: $startDate;

            $types = [
                'toto' => 1,
                'mini_toto_a' => 2,
                'mini_toto_b' => 3,
                'toto_goal3' => 4,
            ];
            $teams = Team::get()->keyBy('name')->toArray();
            foreach ($types as $field => $type) {
                if ($request->$field) {
                    $schedule = Schedule::create([
                        'no' => $request->no,
                        'type' => $type,
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                    ]);

                    $this->storeGames($request->$field, $schedule->id, $teams);
                }
            }
            DB::commit();

            return redirect()->route('admin.schedules.index')->with('success', 'Schedules and games created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function storeGames($gamesText, $scheduleId, $teams)
    {
        $games = explode("\n", trim($gamesText));
        foreach ($games as $game) {
            $gameData = explode(',', $game);
            if (count($gameData) === 3) {
                $homeTeamId = $teams[$gameData[1]]['id'];
                $awayTeamId = $teams[$gameData[2]]['id'];

                Game::create([
                    'schedule_id' => $scheduleId,
                    'home_team_id' => $homeTeamId,
                    'away_team_id' => $awayTeamId,
                    'no' => intval(trim($gameData[0])),
                ]);
            }
        }
    }

    public function edit(Schedule $schedule)
    {
        $schedule->load('games', 'games.homeTeam', 'games.awayTeam');
        $schedule->type_jp = $schedule->type_jp;
        return Inertia::render('Admin/Schedules/Edit', [
            'schedule' => $schedule,
            'games' => $schedule->games,
        ]);
    }

    public function import(Request $request)
    {
        $url = $request->input('url');
        $response = Http::get($url);

        if (!$response->successful()) {
            return response()->json(['message' => 'Failed to fetch the page.'], 500);
        }

        $html = $response->body();
        $document = new Document($html);

        $tables = $document->find('table');
        $gameData = [
            'schedule_no' => substr($url, -4),
            'start_date' => null,
            'toto' => '',
            'mini_toto_a' => '',
            'mini_toto_b' => '',
            'toto_goal3' => '',
        ];

        foreach ($tables as $table) {
            $headers = $table->find('th');

            if (isset($headers[1]) && trim($headers[1]->text()) === '開催日') {
                $rows = $table->find('tr');
                $games = [];

                if (empty($gameData['start_date']) && !empty($rows[1])) {
                    $cells = $rows[1]->find('td');
                    if (isset($cells[1])) {
                        $startDateRaw = trim($cells[1]->text());
                        $currentYear = Carbon::now()->year;
                        $gameData['start_date'] = Carbon::parse("$currentYear/$startDateRaw")->format('Y-m-d'); // 年を追加してフォーマット
                    }
                }

                foreach ($rows as $row) {
                    $cells = $row->find('td');
                    if (count($cells) === 7) {
                        $gameNo = trim($cells[0]->text());
                        $homeTeam = trim($cells[4]->text());
                        $awayTeam = trim($cells[6]->text());
                        $games[] = "$gameNo,$homeTeam,$awayTeam";
                    }
                }

                $gameCount = count($games);
                if ($gameCount >= 8) {
                    $gameData['toto'] = implode("\n", $games);
                } elseif ($gameCount === 5) {
                    if (empty($gameData['mini_toto_a'])) {
                        $gameData['mini_toto_a'] = implode("\n", $games);
                    } else if (empty($gameData['mini_toto_b'])) {
                        $gameData['mini_toto_b'] = implode("\n", $games);
                    }
                    
                } elseif ($gameCount === 3) {
                    $gameData['toto_goal3'] = implode("\n", $games);
                }
            }
        }

        return response()->json($gameData);
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->games()->delete();
        $schedule->delete();

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule and related games deleted successfully.');
    }
}
