<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\files;
use App\Models\question;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportQuestion;
use App\Exports\ExportQuestion;

use Dompdf\Dompdf; // Import the Dompdf class
use Dompdf\Options;

class questionBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Questions = question::where('delete', 0)->get();
        return  view('admin.QuestionBank.index', compact('Questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = category::where('delete', 0)->get();
        return view('admin.QuestionBank.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'file' => 'required|mimes:xls,xlsx',
        ]);

        if ($request->hasFile('file')) {
            // dd($request->category_id);
            $category_id = $request->category_id;
            $file = $request->file('file')->store('temporary');
            $filePath = storage_path('app/' . $file);
            Excel::import(new ImportQuestion($category_id), $filePath);
            // If there are any additional tasks after importing, you can put them here.

            unlink($filePath);
            return redirect()->route('questionBank.index')->with('success', true);
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
        $questions = question::find($id);
        return view('admin.QuestionBank.edit', compact('questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $questions = question::find($id);
        $questions->question = $request->question;
        $questions->opt_a = $request->opt_a;
        $questions->opt_b = $request->opt_b;
        $questions->opt_c = $request->opt_c;
        $questions->opt_d = $request->opt_d;
        $questions->answer = $request->answer;
        $questions->explanation = $request->explanation;
        $questions->update();
        return redirect()->route('questionBank.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function softDelete(string $id)
    {
        $question = question::find($id);
        $question->delete = 1;
        $question->update();
        return redirect()->route('questionBank.index');
    }
    public function destroy(string $id)
    {
        question::find($id)->delete();
        return redirect()->back();
    }
}
