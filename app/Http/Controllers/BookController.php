<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // app/Http/Controllers/BookController.php

    // add these at the top of the file


    public function __construct()
    {
      $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index()
    {
      return BookResource::collection(Book::with('ratings')->paginate(25));
    }

    public function store(Request $request)
    {
      $book = Book::create([
        'user_id' => $request->user()->id,
        'title' => $request->title,
        'description' => $request->description,
      ]);

      return new BookResource($book);
    }

    public function show(Book $book)
    {
      return new BookResource($book);
    }

    public function update(Request $request, Book $book)
    {
      // check if currently authenticated user is the owner of the book
      if ($request->user()->id !== $book->user_id) {
        return response()->json(['error' => 'You can only edit your own books.'], 403);
      }

      $book->update($request->only(['title', 'description']));

      return new BookResource($book);
    }

    public function destroy(Book $book)
    {
      $book->delete();

      return response()->json(null, 204);
    }


}
