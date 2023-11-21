<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $searchType = $request->input('search_type', 'book');

        if ($searchType === 'book') {
            // Cari buku
            $results = Book::where('title', 'like', '%' . $query . '%')->get();
            return view('pages.search.index', compact('results'));
        }

        if ($searchType === 'user') {
            // Cari pengguna
            $users = User::where('name', 'like', '%' . $query . '%')->get();
            return view('pages.search.index', compact('users'));
        }
    }
}
