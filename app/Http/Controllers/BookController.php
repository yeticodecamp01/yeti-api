<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            "title" => "required",
            "book_cost" => "required"
        ]);

        // create book data
        $book = new Book();
        $book->authors_id = auth()->user()->id;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->book_cost = $request->book_cost;

        // save
        $book->save();

        // send response
        return response()->json([
            "status" => 1,
            "message" => "Book created successfully"
        ]);
    }

    public function listBook()
    {
        $books = Book::get();

        return response()->json([
            "status" => 1,
            "message" => "All Books",
            "data" => $books
        ]);
    }

    // Author Book METHOD - GET
    public function authorBook()
    {
        $author_id = auth()->user()->id;
        $books = Authors::find($author_id)->books;

        return response()->json([
            "status" => 1,
            "message" => "Author Books",
            "data" => $books
        ]);
    }
   // SINGLE BOOK METHOD - GET
   public function singleBook($book_id)
   {
       $author_id = auth()->user()->id;

       if (Book::where([
           "authors_id" => $author_id,
           "id" => $book_id
       ])->exists()) {

           $book = Book::find($book_id);

           return response()->json([
               "status" => true,
               "message" => "Book data found",
               "data" => $book
           ]);
       } else {

           return response()->json([
               "status" => false,
               "message" => "Author Book doesn't exists"
           ]);
       }
   }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
      // UPDATE METHOD - POST
      public function updateBook(Request $request, $book_id)
      {

          $author_id = auth()->user()->id;

          if (Book::where([
              "authors_id" => $author_id,
              "id" => $book_id
          ])->exists()) {
              $book = Book::find($book_id);
              //print_r($request->all());die;
              $book->title = isset($request->title) ? $request->title : $book->title;
              $book->description = isset($request->description) ? $request->description : $book->description;
              $book->book_cost = isset($request->book_cost) ? $request->book_cost : $book->book_cost;
              $book->save();
              return response()->json([
                  "status" => 1,
                  "message" => "Book data has been updated"
              ]);
          } else {
              return response()->json([
                  "status" => false,
                  "message" => "Author Book doesn't exists"
              ]);
          }
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */

    // DELETE METHOD - GET
    public function deleteBook($book_id)
    {
        $author_id = auth()->user()->id;

        if (Book::where([
            "authors_id" => $author_id,
            "id" => $book_id
        ])->exists()) {

            $book = Book::find($book_id);

            $book->delete();

            return response()->json([
                "status" => true,
                "message" => "Book has been deleted"
            ]);
        }else{

            return response()->json([
                "status" => false,
                "message" => "Author Book doesn't exists"
            ]);
        }
    }
}
