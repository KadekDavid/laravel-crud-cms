<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    
    public function index(Request $request)
    {
    $category = $request->input('category');

    $query = $category ? Book::where('category', $category) : Book::query();

    $books = $query->get();

    return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'author' => 'required',
            'quantity' => 'required|integer|min:1',
            'file' => 'required|mimes:pdf|max:5120', // 5MB max
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload image
        $imagePath = $request->file('image')->store('books', 'public');
        // Upload file
        $filePath = $request->file('file')->store('books', 'public');

        Book::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'author' => $request->author,
            'quantity' => $request->quantity,
            'file_url' => $filePath,
            'image_url' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'author' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $book->update($request->only(['title', 'category', 'description', 'author', 'quantity']));

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($book->image_url);
            $imagePath = $request->file('image')->store('books', 'public');
            $book->update(['image_url' => $imagePath]);
        }

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($book->file_url);
            $filePath = $request->file('file')->store('books', 'public');
            $book->update(['file_url' => $filePath]);
        }

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {

        // Delete image and file from storage
        Storage::disk('public')->delete($book->image_url);
        Storage::disk('public')->delete($book->file_url);

        // Delete book from database
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
        $this->middleware('book.access')->only('edit', 'update', 'destroy');
    }
    
}
