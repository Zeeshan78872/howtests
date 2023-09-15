<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\mock;
use App\Models\mock_category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class mockController extends Controller
{
    // count share
    public function countShare($id)
    {
        $mock = mock::find($id);
        $previous_count = $mock->shares;
        $mock->shares = $previous_count + 10;
        $mock->update();
        return response()->json(true);
    }
    // top downloaders
    public function topDownloaders()
    {
        $mocks = mock::where('delete', 0)->orderBy('downloads', 'desc')->limit(16)->get();
        return response()->json($mocks);
    }
    // all ajex mocks
    public function ajexMocks(Request $request)
    {
        $count = mock::where('delete', 0)->get()->count();
        $query = mock::query();
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
        $mocks = $query->orderBy('created_at', 'desc')->get();
        return  response()->json([
            'mocks' => $mocks,
            'filter' => $filter,
            'count' => $count
        ]);

        return view('allMocks', compact('mocks', 'filter', 'count'));
    }
    // all mocks
    public function AllMocks(Request $request)
    {
        $count = mock::where('delete', 0)->get()->count();
        $query = mock::query();
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
        $mocks = $query->orderBy('created_at', 'desc')->get();
        if ($request->ajax()) {
            return  response()->json([
                'mocks' => $mocks,
                'filter' => $filter,
                'count' => $count
            ]);
        } else {
            return view('allMocks', compact('mocks', 'filter', 'count'));
        }
        return view('allMocks', compact('mocks', 'filter', 'count'));
    }
    public function MockDetail(mock $mocks)
    {
        $shareComponent = \Share::page(
            'https://www.howtests.com/MockDetail/' . $mocks->slug,
            'Your share text comes here',
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();
        // $mocks = mock::find($id);
        return view('MockDetail', compact('mocks', 'shareComponent'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mocks = mock::where('delete', 0)->get();
        return view('admin.mocks.index', compact('mocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('delete', 0)->whereHas('questions')->get();
        return view('admin.mocks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', Rule::unique('mocks', 'title')
                ->where(function ($query) {
                    $query->where('delete', '!=', '1');
                })],
            'tagline' => 'required',
            'question_per_ch' => 'required',
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
            $request->file->move(public_path('images/mock'), $imageName);
            // dd($request);
            if ($request->hasFile('extra_image')) {
                $extraimage = 'extra_image_' . time() . '.' . $request->extra_image->extension();
                $request->extra_image->move(public_path('images/mockextraimage'), $extraimage);
            } else {
                $extraimage = null;
            }
            // extra image 2
            if ($request->hasFile('extra_image_2')) {
                $extraName_2 = 'extra_image_2_' . time() . '.' . $request->extra_image_2->extension();
                // dd($extraName);
                $request->extra_image_2->move(public_path('images/mockextraimage'), $extraName_2);
            } else {
                $extraName_2 = null;
            }
            $downloadNumber = rand(200, 500);
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
            $mock = mock::create([
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title')), // Set the slug here
                'tagline' => $request->input('tagline'),
                'desc' => $request->input('description'),
                'meta_title' => $meta_title,
                'meta_Keywords' => $request->input('meta_keywords'),
                'meta_description' => $meta_description,
                'author' => $request->input('author'),
                'question_per_ch' => $request->input('question_per_ch'),
                'title_image' => $imageName,
                'extra_image' => $extraimage,
                'extra_image_1' => $extraName_2,
                'downloads' => $downloadNumber,
                'shares' => $shareNumber,
            ]);
            $mock_id = $mock->id;
            $category_ids = $request->input('category_id');
            $Cquestions = $request->input('Cquestion');

            foreach ($category_ids as $index => $category_id) {
                $data[] = [
                    'mock_id' => $mock_id,
                    'category_id' => $category_id,
                    'select_question' => $Cquestions[$index]
                ];
            }
            foreach ($data as $value) {
                mock_category::create($value);
            }
            mock_pdf($mock_id);
            return redirect()->route('Mock.index')->with('success', true);
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
        $mock = mock::find($id);
        return view('admin.mocks.edit', compact('mock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', Rule::unique('mocks', 'title')->ignore($id)
                ->where(function ($query) {
                    $query->where('delete', '!=', '1');
                })],
            'tagline' => 'required',
            'description' => 'required|max:1000',
            'author' => 'required',
            'file' => 'image',
        ]);
        $mock = mock::find($id);
        $mock->title = $request->title;
        $mock->tagline = $request->tagline;
        $mock->desc = $request->description;
        $mock->author = $request->author;
        if ($request->hasFile('file')) {
            $imageName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('images/mock'), $imageName);
            $mock->title_image = $imageName;
        }
        $mock->update();
        return redirect()->route('Mock.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function softDelete(string $id)
    {
        $mock = mock::find($id);
        $mock->delete = 1;
        $mock->update();
        $mock_category = mock_category::where('mock_id', $id);
        $mock_category->update(['delete' => 1]);
        return redirect()->route('Mock.index');
    }
    public function destroy(string $id)
    {
        $files = mock::find($id);
        $filepath = public_path('images/mock/' . $files->title_image);
        unlink($filepath);
        $files->delete();
        mock_category::where('mock_id', $id)->delete();
        return redirect()->back();
    }
}
