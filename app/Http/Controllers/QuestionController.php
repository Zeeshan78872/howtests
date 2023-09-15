<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportQuestion;
use App\Exports\ExportQuestion;
use App\Models\book;
use App\Models\category;
use Dompdf\Dompdf; // Import the Dompdf class
use Dompdf\Options;

use App\Models\files;
use App\Models\clientDetail;
use App\Models\mock;
use App\Models\question;

class QuestionController extends Controller
{
    // check question
    public function checkQuestion($id)
    {
        $total_question = question::where('category_id', $id)->get()->count();
        return response()->json(['total_question' => $total_question, 'id' => $id]);
    }
    public function AddClientMock(Request $request, $id)
    {
        $check_client = clientDetail::where('email', $request->email)->first();
        $db = $request->downloadBy;
        if ($check_client) {
            $check_client->name = $request->name;
            $check_client->city = $request->city;
            $check_client->province = $request->province;
            $check_client->download_type = $request->downloadBy;
            $check_client->update();
        } else {
            $client = new clientDetail();
            $client->name = $request->name;
            $client->email = $request->email;
            $client->city = $request->city;
            $client->province = $request->province;
            $client->download_type = $request->downloadBy;
            $client->save();
        }
        $files = mock::find($id);
        $downloads = $files->downloads;
        $files->downloads = $downloads + 5;
        $files->update();

        return redirect()->back()->with('success', true)->with('download_db', $db)->with('db', $request->downloadBy);
    }
    public function AddClient(Request $request, $id)
    {
        $check_client = clientDetail::where('email', $request->email)->first();
        $db = $request->downloadBy;
        if ($check_client) {
            $check_client->name = $request->name;
            $check_client->city = $request->city;
            $check_client->province = $request->province;
            $check_client->download_type = $request->downloadBy;
            $check_client->update();
        } else {
            $client = new clientDetail();
            $client->name = $request->name;
            $client->email = $request->email;
            $client->city = $request->city;
            $client->province = $request->province;
            $client->download_type = $request->downloadBy;
            $client->save();
        }
        $files = book::find($id);
        $downloads = $files->downloads;
        $files->downloads = $downloads + 5;
        $files->update();

        return redirect()->back()->with('success', true)->with('download_db', $db)->with('db', $request->downloadBy);
    }

    public function CourseList()
    {
        $files = files::all();
        return view('allBooks', compact('files'));
    }
    public function CourseDetail($id, $db = null)
    {
        $files = files::find($id);
        return view('bookDetail', compact('files'));
    }
    public function importView(Request $request)
    {
        return view('importFile');
    }

    public function editCourse($id)
    {
        $files = files::find($id);
        return view('editCourse', compact('files'));
    }
    public function updateCourse(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|max:1024',
        ]);
        $files = files::find($id);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $filepath = public_path('images/' . $files->image);
            unlink($filepath);
            $files->image = $imageName;
        }
        $files->title = $request->title;
        $files->desc = $request->desc;
        $files->QperCh = $request->QperCh;
        if ($request->hasFile('file')) {
            $file_id = $id;
            $file = $request->file('file')->store('temporary');
            $filePath = storage_path('app/' . $file);
            question::where('file_id', $file_id)->delete();
            Excel::import(new ImportQuestion($file_id), $filePath);
            unlink($filePath);
        }
        $files->update();
        return redirect()->route('admin.books.index')->with('success', 'Data updated successfully!');
    }
    public function deleteCourse($id)
    {
        $files = files::find($id);
        $filepath = public_path('images/' . $files->image);
        unlink($filepath);
        $files->delete();
        question::where('file_id', $id)->delete();
        return redirect()->back();
    }
    public function import(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'QperCh' => 'required',
            'file' => 'required|mimes:xls,xlsx',
            'image' => 'image|max:1024',
        ]);
        if ($request->hasFile('file')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $title = files::create([
                'title' => $request->input('title'),
                'desc' => $request->input('desc'),
                'QperCh' => $request->QperCh,
                'image' => $imageName
            ]);
            $file_id = $title->id;
            $file = $request->file('file')->store('temporary');
            $filePath = storage_path('app/' . $file);
            Excel::import(new ImportQuestion($file_id), $filePath);
            // If there are any additional tasks after importing, you can put them here.

            unlink($filePath);
            return redirect()->route('home')->with('success', 'Data imported successfully!');
        }
        return redirect()->back()->with('error', 'Please select an Excel file to upload.');
    }
    public function exportUsers(Request $request)
    {
        return Excel::download(new ExportQuestion, 'users.xlsx');
    }

    public function generatePDF($id, $db)
    {
        // Fetch all questins from the database
        $files = book::find($id);
        $downloads = $files->downloads;
        $files->downloads = $downloads + 5;
        $files->update();
        $categories = $files->category;
        //  dd($categories);
        $questions = question::all();

        $questionsPerChapter = $files->question_per_ch;

        // Calculate the number of chapters
        $totalQuestions = $questions->count();

        // Organize the questions into chapters
        $chapters = $categories->count();

        $chapterPages = [];
        foreach ($categories as $chapterNumber => $chapterQuestions) {
            $chapterPages[] = $chapterNumber + 2; // Adding 2 as the table of contents is on page 1 and the first chapter starts on page 2
        }

        $tableOfContents = view('table_of_contents', compact('categories', 'chapterPages', 'files', 'db'))->render();

        $pdfContent = '';
        // questions
        if ($db != 'AWE') {
            foreach ($categories as $chapterNumber => $category) {
                $chapterQuestions = question::where('category_id', $category->category_id)->inRandomOrder()->take($category->select_question)->get();
                $cat_name = category::find($category->category_id);
                // foreach ($question as $index => $chapterQuestions) {
                // dd($chapterQuestions);
                $chapterQuestions = $chapterQuestions;
                // $questionNum = $questionNum+1;
                $pdfContent .= '<div style="page-break-before: always;" id="chapter_' . ($chapterNumber + 1) . '"> <div class="header-container">
                <div class="header-content">
                    ' . $cat_name->name . '
                </div>
                <div class="header-link">';
                if ($db != 'Q') {
                    $pdfContent .= '
                    <a href="#answer_chapter_' . ($chapterNumber + 1) . '">Answer</a>';
                }
                $pdfContent .= '<a href="#index">Index</a>
                </div> ';

                $pdfContent .= '</div>
                <h1>Test' . ($chapterNumber + 1) . '</h1>
                ' . view('pdf_template', compact('chapterQuestions', 'chapterNumber', 'questionsPerChapter'))->render() . '</div>';
                // }
            }
        }
        // answer

        if ($db != 'Q') {
            foreach ($categories as $chapterNumber => $category) {
                $chapterQuestions = question::where('category_id', $category->category_id)->inRandomOrder()->take($category->select_question)->get();
                $cat_name = category::find($category->category_id);
                $pdfContent .= '<div style="page-break-before: always;" id="answer_chapter_' . ($chapterNumber + 1) . '"> <div class="header-container">
                <div class="header-content">
                ' . $cat_name->name . ' \ Answer Key
                </div>
                <div class="header-link">';
                if ($db != 'AWE') {
                    $pdfContent .= '
                    <a href="#chapter_' . ($chapterNumber + 1) . '">Question</a>';
                }
                $pdfContent .= '<a href="#index">Index</a>
                </div> ';

                $pdfContent .= '</div>
                <h1>Test' . ($chapterNumber + 1) . '</h1>
                ' . view('Answer_pdf_template', compact('chapterQuestions', 'chapterNumber', 'questionsPerChapter', 'db'))->render() . '</div>';
            }
        }

        $pdfHtml = '<html><head>
            <style>   .header-container {
                display: table;
                width: 100%;
            }

            .header-content {
                display: table-cell;
            }

            .header-link {
                display: table-cell;
                text-align: right;
            }
            </style>
            </head><body>' . $tableOfContents . $pdfContent . '</body></html>';

        $pdf = new Dompdf();

        $pdf->loadHtml($pdfHtml);
        $pdf->set_option('isPhpEnabled', true);
        $pdf->set_option('copyDefaultProtection', ['copy']);
        $pdf->set_option('permissions', ['copy']);
        $pdf->render();
        // Replace the page numbers in the PDF with the actual page numbers
        foreach ($chapterPages as $chapterNumber => $pageNumber) {
            $pdf->getCanvas()->page_text(550, 800, "Page " . $pageNumber, null, 10, [0, 0, 0]);
        }
        // $pdf->stream('questions.pdf');
        if ($db == 'Q') {
            $pdfFilename = 'question_' . $id . '.pdf';
            $pdfPath = public_path('pdf/Question/' . $pdfFilename);
        } else {
            $pdfFilename = 'question_answer_' . $id . '.pdf';
            $pdfPath = public_path('pdf/QuestionWA/' . $pdfFilename);
        }


        file_put_contents($pdfPath, $pdf->output());
    }
}
