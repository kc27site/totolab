<?php

namespace App\Http\Controllers;

use App\Enums\BlogStatus;
use App\Enums\ScheduleType;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Team;
use App\Models\Game;
use App\Models\Blog;
use App\Models\Section;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Requests\UpdateSectionsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::released()
            ->orderBy('released_at', 'desc')
            ->get();
        foreach ($blogs as &$blog) {
            $blog->type_jp = $blog->type_jp;
        }
        return Inertia::render('Front/Index', [
            'blogs' => $blogs
        ]);
    }

    public function create()
    {
        $schedule_no_list = Schedule::select('no')
            ->orderByDesc('no')
            ->get()
            ->pluck('no')
            ->unique();
        return Inertia::render('Admin/Blogs/Create', [
            'schedule_no_list' => $schedule_no_list
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule_no' => 'nullable|integer',
            'type' => 'required|integer',
        ]);

        // トランザクションを使用して安全にIDを取得・保存
        DB::transaction(function () use ($validated) {
            // 新しいブログを作成し、IDを取得
            $blog = Blog::create([
                'schedule_no' => $validated['schedule_no'] ?? null,
                'type' => $validated['type'],
                'status' => 1,
            ]);

            // 年+IDで`no`をセット
            $year = now()->year;
            $blog->no = $year . $blog->id;
            $blog->save();
        });

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $blog->load('sections', 'schedules', 'schedules.games');
        $teams = Team::pluck('name', 'id');
        return Inertia::render('Admin/Blogs/Edit', [
            'blog' => $blog,
            'initialSections' => $blog->sections,
            'schedules' => $blog->schedules,
            'teams' => $teams,
            'scheduleTypes'=> ScheduleType::getAll(),
        ]);
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        DB::beginTransaction();
        try {
            $params = [
                'title' => $request->title,
                'type' => $request->type,
                'status' => intval($request->status),
            ];
            if (!$blog->released_at && intval($request->status) === BlogStatus::RELEASED) {
                $params['released_at'] = Carbon::now();
            }
            $blog->update($params);
            DB::commit();
            return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to save Blog.');
        }
    }

    
    public function updateSections(UpdateSectionsRequest $request, Blog $blog)
    {
        DB::transaction(function () use ($request, $blog) {
            $sectionsData = $request->input('sections', []);
            $existingSectionIds = $blog->sections()->pluck('id')->toArray();
            foreach ($sectionsData as $sectionData) {
                if (isset($sectionData['id'])) {
                    $section = Section::find($sectionData['id']);
                    $section->update([
                        'type' => $sectionData['type'],
                        'content' => $sectionData['content'],
                        'game_id' => $sectionData['game_id'] ?? null,
                        'schedule_id' => $sectionData['schedule_id'] ?? null,
                        'position' => $sectionData['position'],
                    ]);
                    $existingSectionIds = array_diff($existingSectionIds, [$section->id]);
                } else {
                    $blog->sections()->create([
                        'type' => $sectionData['type'],
                        'content' => $sectionData['content'],
                        'game_id' => $sectionData['game_id'] ?? null,
                        'schedule_id' => $sectionData['schedule_id'] ?? null,
                        'position' => $sectionData['position'],
                    ]);
                }
            }

            // 削除されるべきセクションを削除
            Section::whereIn('id', $existingSectionIds)->delete();
        });

        return redirect()->route('admin.blogs.edit', $blog)->with('success', 'Sections updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->status === BlogStatus::CLOSED) {
            $blog->sections()->delete();
            $blog->delete();
            return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
        }
        return redirect()->back()->with('error', 'status is not CLOSED.');
    }
}
