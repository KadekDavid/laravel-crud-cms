@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="container">
                    <h2 class="text-2xl font-bold mb-4">Add Book</h2>
                    <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Judul Buku:</label>
                            <input type="text" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-300" id="title" name="title" required>
                        </div>
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Penulis:</label>
                            <input type="text" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-300" id="author" name="author" required>
                        </div>
                        <div class="mb-4">
                            <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Kategori Buku:</label>
                            <select id="category" name="category" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-300" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="Fiksi">Fiksi</option>
                                <option value="Non-Fiksi">Non-Fiksi</option>
                                <option value="Novel">Novel</option>
                                <!-- Tambahkan opsi kategori buku lainnya sesuai kebutuhan -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                            <textarea class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-300" id="description" name="description" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Buku:</label>
                            <input type="number" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-300" id="quantity" name="quantity" required>
                        </div>                        
                        <div class="mb-4">
                            <label for="file" class="block text-gray-700 text-sm font-bold mb-2">Upload File Buku (PDF):</label>
                            <input type="file" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-300" id="file" name="file" accept=".pdf" required>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Upload Cover Buku (jpeg/jpg/png):</label>
                            <input type="file" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-300" id="image" name="image" accept="image/jpeg,image/jpg,image/png" required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambah Buku</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
