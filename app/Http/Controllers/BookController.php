<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\book;
use App\Models\category_book;

use App\Helpers\pdfGenerater;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class BookController extends Controller
{

    // count share
    public function countShare($id)
    {
        $book = book::find($id);
        $previous_count = $book->shares;
        $book->shares = $previous_count + 10;
        $book->update();
        return response()->json(true);
    }
    // top downloders
    public function topDownloaders()
    {

        $books = book::where('delete', 0)->orderBy('downloads', 'desc')->limit(16)->get();
        return response()->json($books);
    }
    // all books
    public function ajexBooks(Request $request)
    {
        $count = book::where('delete', 0)->get()->count();
        $query = book::query();
        $query = $query->where('delete', 0);
        if ($request->isMethod('post')) {
            $filter = $request->all();
            if ($filter['sort_by']) {
                if ($filter['sort_by'] == 'A-Z') {
                    $query = $query->orderBy('title', 'asc');
                } else {
                    $query = $query->orderBy('title', 'desc');
                }
            }
            if ($filter['currentCount']) {
                $query = $query->limit($filter['currentCount']);
            }
        } else {

            $query = $query->limit(12);
            $filter = null;
        }
        $books = $query->orderBy('created_at', 'desc')->get();
        return  response()->json([
            'books' => $books,
            'filter' => $filter,
            'count' => $count
        ]);
    }
    public function AllBooks(Request $request)
    {
        $count = book::where('delete', 0)->get()->count();
        $query = book::query();
        $query = $query->where('delete', 0);
        if ($request->isMethod('post')) {
            $filter = $request->all();
            if ($filter['sort_by']) {
                if ($filter['sort_by'] == 'A-Z') {
                    $query = $query->orderBy('title', 'asc');
                } else {
                    $query = $query->orderBy('title', 'desc');
                }
            }
            if ($filter['currentCount']) {
                $query = $query->limit($filter['currentCount']);
            }
        } else {

            $query = $query->limit(12);
            $filter = null;
        }
        $books = $query->orderBy('created_at', 'desc')->get();
        if ($request->ajax()) {
            return  response()->json([
                'books' => $books,
                'filter' => $filter,
                'count' => $count
            ]);
        } else {
            return view('allBooks', compact('books', 'filter', 'count'));
        }
    }
    public function BookDetail(book $books)
    {
        $shareComponent = \Share::page(
            'https://www.howtests.com/BookDetail/' . $books->slug,
            'Your share text comes here',
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();
        // $shareComponent = '';
        return view('bookDetail', compact('books', 'shareComponent'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = book::where('delete', 0)->get();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('delete', 0)->whereHas('questions')->get();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', Rule::unique('books', 'title')
                ->where(function ($query) {
                    $query->where('delete', '!=', '1');
                })],
            'tagline' => 'required',
            'description' => 'required|max:1000',
            'author' => 'required',
            'meta_keywords' => 'required',
            'file' => 'required|image',
            'extra_image' => 'image',
            'extra_image_2' => 'image',
            'category_id.*' => 'required',
            'Cquestion.*' => 'required'
        ]);
        // dd($request);
        if ($request->hasFile('file')) {
            $imageName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('images'), $imageName);
            // extra image
            if ($request->hasFile('extra_image')) {
                $extraName = 'extra_image_' . time() . '.' . $request->extra_image->extension();
                // dd($extraName);
                $request->extra_image->move(public_path('images/extraimage'), $extraName);
            } else {
                $extraName = null;
            }
            // extra image 2
            if ($request->hasFile('extra_image_2')) {
                $extraName_2 = 'extra_image_2_' . time() . '.' . $request->extra_image_2->extension();
                // dd($extraName);
                $request->extra_image_2->move(public_path('images/extraimage'), $extraName_2);
            } else {
                $extraName_2 = null;
            }
            if ($request->has('featured') && $request->input('featured') == 1) {
                $featured = $request->featured;
            } else {
                $featured = 0;
            }
            $downloadNumber = rand(200, 500);
            // dd($downloadNumber);
            $shareNumber = rand(200, 500);
            $meta_title = $request->input('meta_title');
            $meta_description = $request->input('meta_desc');
            if (empty($meta_title) || $meta_title == null) {
                $meta_title = $request->input('title');
            }
            if (empty($meta_description) || $meta_description == null) {
                $meta_description = $request->input('description');
                $meta_description = substr($meta_description, 0, 120);
            }
            $book = book::create([
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title')), // Set the slug here
                'tagline' => $request->input('tagline'),
                'desc' => $request->input('description'),
                'meta_title' => $meta_title,
                'meta_Keywords' => $request->input('meta_keywords'),
                'meta_description' => $meta_description,
                'author' => $request->input('author'),
                'question_per_ch' => '0',
                'title_image' => $imageName,
                'extra_image' => $extraName,
                'extra_image_1' => $extraName_2,
                'featured_id' => $featured,
                'downloads' => $downloadNumber,
                'shares' => $shareNumber,
            ]);
            // dd($book);
            $book_id = $book->id;
            $category_ids = $request->input('category_id');
            $Cquestions = $request->input('Cquestion');

            foreach ($category_ids as $index => $category_id) {
                $data[] = [
                    'book_id' => $book_id,
                    'category_id' => $category_id,
                    'select_question' => $Cquestions[$index]
                ];
            }
            foreach ($data as $value) {
                category_book::create($value);
            }
            book_pdf($book_id);
            return redirect()->route('Book.index')->with('success', true);
        }
        return redirect()->back()->with('error', 'Please select an Excel file to upload.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = book::find($id);
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => [
                'required',
                Rule::unique('books', 'title')
                    ->ignore($id, 'id')
                    ->where(function ($query) {
                        $query->where('delete', '!=', '1');
                    })
            ],
            'tagline' => 'required',
            'description' => 'required|max:1000',
            'author' => 'required',
            'file' => 'image',
        ]);
        $book = book::find($id);
        $book->title = $request->title;
        $book->tagline = $request->tagline;
        $book->desc = $request->description;
        $book->author = $request->author;
        if ($request->hasFile('file')) {
            $imageName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('images'), $imageName);
            $book->title_image = $imageName;
        }
        $book->update();
        return redirect()->route('Book.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function softDelete(string $id)
    {
        $book = book::find($id);
        $book->delete = 1;
        $book->update();
        $category_book = category_book::where('book_id', $id);
        $category_book->update(['delete' => 1]);
        return redirect()->route('Book.index');
    }
    public function destroy(string $id)
    {
        $files = book::find($id);
        // dd($files);
        $filepath = public_path('images/' . $files->title_image);
        unlink($filepath);
        $files->delete();
        category_book::where('book_id', $id)->delete();
        return redirect()->back();
    }
}