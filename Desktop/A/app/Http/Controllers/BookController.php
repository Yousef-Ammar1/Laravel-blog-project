<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeBookRequest;
use App\Http\Requests\UpdateBookRequestt;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Maize\Markable\Models\Favorite;

class BookController
{
    public function index()
    {

        $books = Book::all();
        return response()->json($books);

    }

    public function show(Book $book)
    {
        return response()->json(new BookResource($book));
    }


    public function store(storeBookRequest $request)
    {
        return new BookResource(Book::create($request->all()));
    }




    public function update(UpdateBookRequestt $request, Book $book)
    {
        $book->update($request->all());
    }

    public function destroy()
    {

    }

    public function filterBooks(Request $request)
    {
        $selectedCategory = $request->input('category_id');
        $selectedSubcategory = $request->input('subcategory_id');

        $query = Book::query();

        if ($selectedCategory) {
            $query->where('category_id', $selectedCategory);
        }

        if ($selectedSubcategory) {
            $query->where('subcategory_id', $selectedSubcategory);
        }

        $filteredBooks = $query->get();
        $categories = Category::all();
        $subcategories = Subcategory::all();

        return response()->json([
            'books' => BookResource::collection($filteredBooks),
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }
    public function toggleFavorite(Request $request, $bookId)
{
    $user = $request->user();

    $book = Book::findOrFail($bookId);

    Favorite::toggle($book, $user);

    return Bookmark::markableRelationName();
}



}
