<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $validated = $request->validate([
            'body' => 'required|string|min:5',
        ]);

        // Shortcut Eloquent untuk simpan + otomatis isi 'question_id'
        $question->answers()->create([
            'body' => $validated['body'],
            'user_id' => Auth::id(), // ID user yg sedang login
        ]);

        return redirect()->route('questions.show', $question->id)->with('success', 'Jawaban berhasil dikirim!');
    }

    public function edit(Answer $answer)
    {
        // Otorisasi: Pastikan hanya pemilik yang bisa edit
        if (Auth::id() !== $answer->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES');
        }
        return view('answers.edit', compact('answer'));
    }

    public function update(Request $request, Answer $answer)
    {
        // Otorisasi: Pastikan hanya pemilik yang bisa update
        if (Auth::id() !== $answer->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES');
        }

        $validated = $request->validate([
            'body' => 'required|string|min:5',
        ]);

        $answer->update($validated);

        // Redirect kembali ke halaman pertanyaan
        return redirect()->route('questions.show', $answer->question_id)->with('success', 'Jawaban berhasil diupdate!');
    }

    public function destroy(Answer $answer)
    {
        // Otorisasi: Pastikan hanya pemilik yg bisa hapus
        if (Auth::id() !== $answer->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES');
        }

        $answer->delete();

        // Redirect kembali ke halaman pertanyaan
        return redirect()->route('questions.show', $answer->question_id)->with('success', 'Jawaban berhasil dihapus!');
    }
}
