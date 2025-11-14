<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Jawaban Anda') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4 text-sm text-gray-600">Mengedit jawaban untuk pertanyaan: <a href="{{ route('questions.show', $answer->question_id) }}" class="text-blue-500 hover:underline font-semibold">{{ Str::limit($answer->question->title, 60) }}</a></p>

                    <form method="POST" action="{{ route('answers.update', $answer->id) }}">
                        @csrf
                        @method('PATCH') <div>
                            <textarea id="body" name="body" rows="8" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">{{ old('body', $answer->body) }}</textarea>
                            @error('body')
                                <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>