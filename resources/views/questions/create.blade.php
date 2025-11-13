<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Pertanyaan Baru') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg relative">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('questions.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="title" class="block font-medium text-sm text-gray-700">Judul</label>
                            <input id="title" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text" name="title" value="{{ old('title') }}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div class="mt-4">
                            <label for="category_id" class="block font-medium text-sm text-gray-700">Kategori</label>
                            <select name="category_id" id="category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />

                        </div>
                        <div class="mt-4">
                            <label for="body" class="block font-medium text-sm text-gray-700">Isi Pertanyaan</label>
                            <textarea id="body" name="body" rows="5" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">{{ old('body') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('body')" />
                        </div>

                        <div class="mt-4">
                            <label for="tags" class="block font-medium text-sm text-gray-700">Tags (Pisahkan dengan koma)</label>
                            <input id="tags" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text" name="tags" value="{{ old('tags') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('tags')" />
                        </div>

                        <div class="mt-4">
                            <label for="image" class="block font-medium text-sm text-gray-700">Gambar (Opsional)</label>
                            <input id="image" class="block mt-1 w-full" type="file" name="image" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Publikasikan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>