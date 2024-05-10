<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.books.index', [
            'books' => Book::paginate(5)
        ]);
    }
    public function show(Book $book)
    {
        return view('books.show', [
            'book' => $book
        ]);
    }
    public function create(Book $book)
    {
        return view('admin.books.create', [
            'book' => $book,
        ]);
    }
    public function store()
{
    try {
        $validatedData = $this->validateBook();

        $book = new Book;
        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->subcategory_id = $validatedData['subcategory_id'];
        $book->description = $validatedData['description'];
        $book->isbn = $validatedData['isbn'];
        $book->save();

        return redirect('admin/books')->with('success', 'Book created successfully');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'There was a problem creating the book: ' . $e->getMessage()]);
    }
}
    public function edit(Book $book)
    {
        return view('admin.books.edit', [
            'book' => $book
        ]);
    }
    public function update(Book $book)
    {
        $attributes = $this->validateBook($book);
        $book->update($attributes);

        return redirect('/admin/books')->with('success', 'Book Updated');
    }
    public function destroy(Book $book)
    {
        $book->delete();
        return back()->with('success', 'Book Deleted');

    }
    protected function validateBook(?Book $book = null): array
    {
        $book ??= new Book();
        return request()->validate([
            'title' => ['required', Rule::unique('books', 'title')->ignore($book->id)],
            'subcategory_id' => ['required', Rule::exists('subcategories', 'id')],
            'author' => 'required|max:255',
            'isbn' => 'required',
            'description' => ['required', Rule::unique('books', 'description')->ignore($book->id)],
        ]);
    }

    public function createCategory()
{
    return view('admin.categories.create');
}

public function storeCategory(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255|unique:categories,name',
        'description' => 'required|unique:categories,description',
    ]);

    Category::create($validatedData);

    return redirect('/admin/books')->with('success', 'Category created successfully');
}

public function createSubcategory()
{
    return view('admin.subcategories.create');
}

public function storeSubcategory(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255|unique:subcategories,name',
        'category_id' => 'required|exists:categories,id',
    ]);

    Subcategory::create($validatedData);

    return redirect('/admin/books')->with('success', 'Subcategory created successfully');
}
}
