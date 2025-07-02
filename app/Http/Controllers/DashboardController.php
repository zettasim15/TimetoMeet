<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;
use App\Models\Meeting;
use App\Models\Schedule;
use App\Models\Team;

class DashboardController extends Controller
{
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $user_id = $user->id;

        // Ambil informasi pengguna
        $profile_image = $user->profile_image ?? 'default_profile.png';

        // Jumlah meeting
        $meetings_count = Meeting::where('assignee', $user_id)->count();

        // Jumlah schedule
        $schedule_count = Schedule::join('team_members', 'team_members.user_id', '=', 'schedules.assignee')
                                  ->where('team_members.user_id', $user_id)
                                  ->where('team_members.status', 'active')
                                  ->count();

        // Jumlah teams
        $teams_count = Team::where('user_id', $user_id)->where('status', 'active')->count();

        // Ambil daftar tugas
        $tasks = Task::where('member_id', $user_id)->get();

        // Cek apakah login pertama
        if ($user->is_first_login == 1) {
            return redirect()->route('customize_profile');
        }

        return view('dashboard.member', compact(
            'user', 'profile_image', 'meetings_count', 'schedule_count', 'teams_count', 'tasks'
        ));
    }
}
