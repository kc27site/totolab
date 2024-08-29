<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Prediction;
use App\Models\Team;
use App\Models\Game;
use App\Http\Requests\PredictionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Carbon\Carbon;

class PredictionController extends Controller
{
    public function edit($schedule_no)
    {
        $schedules = Schedule::with('games', 'games.prediction')
            ->where('no', $schedule_no)
            ->orderBy('type')
            ->get();
        $teams = Team::pluck('name', 'id');
        foreach ($schedules as &$schedule) {
            $schedule->type_jp = $schedule->type_jp;
        }

        return Inertia::render('Admin/Predictions/Edit', [
            'schedules' => $schedules,
            'teams' => $teams
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        DB::beginTransaction();
        try {
            foreach ($data as $predictionData) {
                $prediction = Prediction::updateOrCreate(
                    ['schedule_id' => $predictionData['schedule_id'], 'game_id' => intval($predictionData['game_id'])],
                    [
                        'result_0' => !empty($predictionData['result_0']) ? 1 : 0,
                        'result_1' => !empty($predictionData['result_1']) ? 1 : 0,
                        'result_2' => !empty($predictionData['result_2']) ? 1 : 0,
                    ]
                );
            }
            DB::commit();
            return redirect()->back()->with('success', 'Predictions saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to save predictions.');
        }
    }
}
