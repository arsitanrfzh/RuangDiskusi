<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Question;
use App\Models\Category;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('user', 'category')->latest()->get();
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua kategori untuk dropdown
        $categories = Category::all();
        return view('questions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan gambar ke 'storage/app/public/images/questions'
            $imagePath = $request->file('image')->store('images/questions', 'public');
        }

        Question::create([
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'body' => $validated['body'],
            'image' => $imagePath,
            'user_id' => Auth::id(), // Ambil ID user yang login
        ]);

        return redirect()->route('questions.index')->with('success', 'Pertanyaan berhasil dipublikasikan!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        // Muat relasi 'answers' dan 'user' di dalam 'answers'
        $question->load('answers.user');

        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        // Memastikan hanya pemilik yg bisa edit pertanyaan
        if (Auth::id() !== $question->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES');
        }
        $categories = Category::all();
        return view('questions.edit', compact('question', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        // Memastikan hanya pemilik yg bisa update pertanyaan
        if (Auth::id() !== $question->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $question->image; // Ambil path gambar lama

        if ($request->hasFile('image')) {
            // Hapus gambar LAMA (jika ada)
            if ($question->image) {
                Storage::delete('public/' . $question->image);
            }
            // Simpan gambar BARU
            $imagePath = $request->file('image')->store('images/questions', 'public');
        }

        $question->update([
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'body' => $validated['body'],
            'image' => $imagePath,
        ]);

        return redirect()->route('questions.show', $question->id)->with('success', 'Pertanyaan berhasil diupdate!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        // Memastikan hanya pemilik yg bisa menghapus pertanyaan
        if (Auth::id() !== $question->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES');
        }

        // Hapus gambar dari storage (jika ada)
        if ($question->image) {
            Storage::delete('public/' . $question->image);
        }

        // Hapus pertanyaan (jawaban akan ikut terhapus krn 'onDelete('cascade')' di migrasi)
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Pertanyaan berhasil dihapus!');
    }
}
