<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Pertanyaan') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg relative">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('questions.update', $question->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <div>
                            <label for="title" class="block font-medium text-sm text-gray-700">Judul</label>
                            <input id="title" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text" name="title" value="{{ old('title', $question->title) }}" required autofocus />
                        </div>
                        <div class="mt-4">
                            <label for="category_id" class="block font-medium text-sm text-gray-700">Kategori</label>
                            <select name="category_id" id="category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $question->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="body" class="block font-medium text-sm text-gray-700">Isi Pertanyaan</label>
                            <textarea id="body" name="body" rows="5" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">{{ old('body', $question->body) }}</textarea>
                        </div>
                        <div class="mt-4">
                            <label for="image" class="block font-medium text-sm text-gray-700">Gambar (Opsional)</label>
                            @if ($question->image)
                            <div class="my-2">
                                <img src="{{ asset('storage/' . $question->image) }}" alt="Gambar Lama" class="w-1/4 h-auto rounded">
                                <small>Gambar saat ini. Upload baru untuk mengganti.</small>
                            </div>
                            @endif
                            <input id="image" class="block mt-1 w-full" type="file" name="image" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Update Pertanyaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>