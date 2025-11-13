<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Forum Tanya Jawab') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('questions.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    Buat Pertanyaan Baru
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <div class="md:col-span-1">
                    <div class="bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="font-semibold text-lg mb-4">Kategori</h3>
                            <ul class="space-y-2">
                                <li>
                                    <a href="{{ route('questions.index') }}" class="text-blue-600 hover:text-blue-800 {{ !request()->has('category') ? 'font-bold' : '' }}">
                                        Tampilkan Semua
                                    </a>
                                </li>
                                @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('questions.index', ['category' => $category->slug]) }}" class="text-blue-600 hover:text-blue-800 {{ request('category') == $category->slug ? 'font-bold' : '' }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="mt-4 bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <a href="{{ route('categories.index') }}" class="text-sm text-gray-600 hover:text-gray-800">
                                Kelola Kategori
                            </a>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-3">
                    <div class="bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 space-y-4"> @forelse ($questions as $question)
                            <div class="p-4 border rounded-lg">
                                <h3 class="font-semibold text-lg">
                                    <a href="{{ route('questions.show', $question->id) }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $question->title }}
                                    </a>
                                </h3>
                                <div class="text-sm text-gray-600 mt-1">
                                    Ditanyakan oleh: {{ $question->user->name }} |
                                    Kategori: {{ $question->category->name }}
                                </div>
                                <div class="flex flex-wrap gap-2 my-2">
                                    @foreach ($question->tags as $tag)
                                    <span class="px-2 py-1 bg-gray-200 text-gray-700 rounded-full text-xs">
                                        {{ $tag->name }}
                                    </span>
                                    @endforeach
                                </div>
                                <p class="mt-2 text-gray-700">{{ Str::limit($question->body, 150) }}</p>
                            </div>
                            @empty
                            <p class="text-gray-500">Belum ada pertanyaan (atau tidak ada di kategori ini).</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>