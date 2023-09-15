<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\category;
use App\Models\clientDetail;
use Illuminate\Http\Request;
use App\Models\files;
use App\Models\mock;
use App\Models\question;
use App\Models\subscribe;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAnalyticsReport()
    {
        $pages = Analytics::fetchMostVisitedPages(Period::days(7));
        return $pages;
        dd($pages);
        // return view('records', compact('site_id', 'report_id', 'reports', 'analyticsData'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = book::where('delete', 0)->get()->count();
        $mock = mock::where('delete', 0)->get()->count();
        $category = category::where('delete', 0)->get()->count();
        $question = question::where('delete', 0)->get()->count();
        $clientDetail = clientDetail::all()->count();
        $subscribe = subscribe::all()->count();
        // dd($subscribe);
        return view('admin.index', compact('books', 'mock', 'category', 'question', 'clientDetail', 'subscribe'));
    }
    public function bookExplanation($id)
    {
        // dd($id);
        book_pdf($id);
        // pdfExplanation($id);
        return redirect()->back();
    }
    public function mockExplanation($id)
    {
        // dd($id);
        mock_pdf($id);
        // mockPdfExplanation($id);
        return redirect()->back();
    }
}
