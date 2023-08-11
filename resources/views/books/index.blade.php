@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="container">

                    <form action="{{ route('books.index') }}" method="get" class="mb-4">
                        <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Filter by Category:</label>
                        <select id="category" name="category" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-300">
                            <option value="" selected>Semua Categories</option>
                            <option value="Fiksi">Fiksi</option>
                            <option value="Non-Fiksi">Non-Fiksi</option>
                            <option value="Novel">Novel</option>
                        </select>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-blue font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Filter</button>
                    </form>

                    <table class="table mt-2 w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left">No</th>
                                <th class="px-6 py-3 text-left">Gambar</th>
                                <th class="px-6 py-3 text-left">Judul</th>
                                <th class="px-6 py-3 text-left">Penulis</th>
                                <th class="px-6 py-3 text-left">Deskripsi</th>
                                <th class="px-6 py-3 text-left">Kategori</th>
                                <th class="px-6 py-3 text-left">jumlah Buku</th>
                                <th class="px-6 py-3 text-left">File Buku</th>
                                <th class="px-6 py-3">Action</th>
                    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $index => $book)
                                <tr>
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">
                                        <img src="{{ asset('storage/' . $book->image_url) }}" alt="{{ $book->title }}" class="w-16 h-16 object-cover rounded">
                                    </td>
                                    <td class="px-6 py-4">{{ $book->title }}</td>
                                    <td class="px-6 py-4">{{ $book->author }}</td>
                                    <td class="px-6 py-4">{{ $book->description }}</td>
                                    <td class="px-6 py-4">{{ $book->category }}</td>
                                    <td class="px-6 py-4">{{ $book->quantity }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ asset('storage/' . $book->file_url) }}" class="text-blue-500 hover:underline">Download</a>
                                    </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @if($book->user_id === Auth::id() || Auth::user()->isAdmin())
                                                <a href="{{ route('books.edit', $book->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Edit</a>
                                                <form action="{{ route('books.destroy', $book->id) }}" method="post" class="inline ml-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure you want to delete this book?')">Hapus</button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
