<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBookAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $user = Auth::user();

        // if ($user->isAdmin()) {
        //     // Jika pengguna adalah admin, izinkan akses penuh
        //     return $next($request);
        // }

        // // Jika pengguna bukan admin, cek apakah buku milik mereka atau tidak
        // $bookId = $request->route('book');
        // $book = \App\Models\Book::find($bookId);

        // if (!$book || $book->user_id !== $user->id) {
        //     // Jika buku tidak ditemukan atau bukan milik pengguna, larang akses
        //     return redirect()->route('books.index')->with('error', 'Access denied.');
        // }

        return $next($request);
    }
}
