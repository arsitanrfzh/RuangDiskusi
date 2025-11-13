<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-semibold mb-4">5 Pertanyaan Terakhir Saya</h3>
                            <div class="space-y-4">
                                @forelse ($myQuestions as $question)
                                <div class="border-b pb-2">
                                    <a href="{{ route('questions.show', $question->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                                        {{ $question->title }}
                                    </a>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Dibuat pada: {{ $question->created_at->format('d M Y') }}
                                    </p>
                                </div>
                                @empty
                                <p class="text-gray-500">Anda belum membuat pertanyaan.</p>
                                <a href="{{ route('questions.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    Buat Pertanyaan Pertama Anda
                                </a>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="space-y-6">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <h3 class="text-lg font-semibold mb-4">Statistik Saya</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Total Pertanyaan Saya</span>
                                        <span class="font-bold text-2xl">{{ $myTotalQuestions }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Total Jawaban Saya</span>
                                        <span class="font-bold text-2xl">{{ $myTotalAnswers }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <h3 class="text-lg font-semibold mb-4">Aksi Cepat</h3>
                                <div class="space-y-3">
                                    <a href="{{ route('questions.create') }}" class="block w-full text-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                        Buat Pertanyaan
                                    </a>
                                    <a href="{{ route('profile.edit') }}" class="block w-full text-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                                        Edit Profil
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>