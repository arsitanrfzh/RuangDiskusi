<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Forum Tanya Jawab') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('questions.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    Buat Pertanyaan Baru
                </a>
            </div>
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse ($questions as $question)
                    <div class="mb-4 p-4 border rounded-lg">
                        <h3 class="font-semibold text-lg">
                            <a href="{{ route('questions.show', $question->id) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $question->title }}
                            </a>
                        </h3>
                        <div class="text-sm text-gray-600 mt-1">
                            Ditanyakan oleh: {{ $question->user->name }} |
                            Kategori: {{ $question->category->name }}
                        </div>
                        <p class="mt-2 text-gray-700">{{ Str::limit($question->body, 150) }}</p>
                    </div>
                    @empty
                    <p class="text-gray-500">Belum ada pertanyaan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>