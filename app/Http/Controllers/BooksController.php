<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        if ($request->has('available') && $request->available == '1') {
            $query->where('is_available', true);
        }
        
        $books = $query->paginate(12);
        $categories = Category::all();
        
        return view('user.books.index', compact('books', 'categories'));
    }
    
    public function show(Book $book)
    {
        return view('user.books.show', compact('book'));
    }
}
