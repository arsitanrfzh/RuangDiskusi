<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data untuk kartu statistik
        $totalQuestions = Question::count();
        $totalAnswers = Answer::count();
        $totalUsers = User::count();

        // 2. Ambil 5 pertanyaan terakhir dari user yang login
        $myQuestions = Question::where('user_id', Auth::id())
            ->latest() // Urutkan dari yg terbaru
            ->take(5)    // Ambil 5 saja
            ->get();

        // 3. Kirim semua data ke view
        return view('dashboard', compact(
            'totalQuestions',
            'totalAnswers',
            'totalUsers',
            'myQuestions'
        ));
    }
}
