<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $query = Borrowing::with(['user', 'book']);
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('book', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('status') && !empty($request->status)) {
            if ($request->status === 'active') {
                $query->whereNull('returned_at')
                      ->where('return_date', '>=', now());
            } elseif ($request->status === 'returned') {
                $query->whereNotNull('returned_at');
            } elseif ($request->status === 'overdue') {
                $query->whereNull('returned_at')
                      ->where('return_date', '<', now());
            }
        }
        
        $borrowings = $query->orderBy('borrow_date', 'desc')->paginate(10);
        
        return view('admin.borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        $books = Book::where('is_available', true)->get();
        return view('admin.borrowings.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date|before_or_equal:today',
            'return_date' => 'required|date|after:borrow_date',
        ]);

        $book = Book::findOrFail($request->book_id);
        
        if (!$book->is_available) {
            return back()->with('error', 'This book is not available for borrowing.');
        }
        
        $borrowing = Borrowing::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
        ]);
        
        $book->update(['is_available' => false]);
        
        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Borrowing created successfully.');
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->returned_at) {
            return back()->with('error', 'This book has already been returned.');
        }
        
        $borrowing->update(['returned_at' => now()]);
        $borrowing->book->update(['is_available' => true]);
        
        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Book returned successfully.');
    }

    public function destroy(Borrowing $borrowing)
    {
        if (!$borrowing->returned_at) {
            $borrowing->book->update(['is_available' => true]);
        }
        
        $borrowing->delete();
        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Borrowing record deleted successfully.');
    }

    public function show(Borrowing $borrowing)
    {
        return view('admin.borrowings.show', compact('borrowing'));
    }
}
