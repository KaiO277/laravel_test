<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Rating;
use App\Http\Resources\RatingResource;

class RatingController extends Controller
{
        // app/Http/Controllers/RatingController.php

    // add these at the top of the file


    public function __construct()
    {
      $this->middleware('auth:api');
    }

    public function store(Request $request, Book $book)
    {
      $rating = Rating::firstOrCreate(
        [
          'user_id' => $request->user()->id,
          'book_id' => $book->id,
        ],
        ['rating' => $request->rating]
      );

      return new RatingResource($rating);
    }


}
