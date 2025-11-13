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
        // 1. Ambil data untuk kartu "Statistik Saya"
        $myTotalQuestions = Question::where('user_id', Auth::id())->count();
        $myTotalAnswers = Answer::where('user_id', Auth::id())->count();

        // 2. Ambil 5 pertanyaan terakhir dari user yang login (Ini tetap sama)
        $myQuestions = Question::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        // 3. Kirim data baru ke view
        return view('dashboard', compact(
            'myTotalQuestions',
            'myTotalAnswers',
            'myQuestions'
        ));
    }
}
