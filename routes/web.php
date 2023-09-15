<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\questionBankController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\mockController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\searchController;

use App\Models\book;
use App\Models\mock;
use App\Services\Trending;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('googleAnalytics', [HomeController::class, 'showAnalyticsReport']);
Route::match(['get', 'head'], 'BookDetail', function () {
    return view('bookDetail');
});
Route::match(['get', 'head'], 'AboutUs', function () {
    return view('about');
})->name('aboutsU');
Route::match(['get', 'head'], 'ContactUs', function () {
    return view('contactUs');
})->name('contactUs');
Route::post('contactus/store', [ClientController::class, 'store'])->name('contactUs.store');
Route::match(['get', 'head'], '/', function () {

    $books = book::where('delete', 0)->where('featured_id', 1)->limit(4)->get();
    $Populers = book::where('delete', 0)->orderBy('shares', 'desc')->limit(8)->get();
    $PopulersMocks = mock::where('delete', 0)->orderBy('shares', 'desc')->limit(8)->get();
    return view('index', compact('books', 'Populers', 'PopulersMocks'));
});
// search
Route::match(['get', 'head', 'post'], 'search', [searchController::class, 'search'])->name('search');

// generate pdf :
Route::match(['get', 'head'], '/generate-pdf/{id}/{db}', [QuestionController::class, 'generatePDF'])->name('generatePDF');

// Route::match(['get','head'],'/',[QuestionController::class,'CourseList'])->name('courseList');
// Route::match(['get','head'],'allBook', [QuestionController::class, 'CourseList'])->name('courseList');

Route::match(['get', 'head'], 'Book/Detail/{id}/{db?}', [QuestionController::class, 'CourseDetail'])->name('CourseDetail');
//
Route::post('addClient/{id}', [QuestionController::class, 'AddClient'])->name('addClient');
Route::post('AddClientMock/{id}', [QuestionController::class, 'AddClientMock'])->name('AddClientMock');
Route::match(['get', 'head'], '/fileimport', [QuestionController::class, 'importView'])->name('import-view');
// upload course
Route::post('/import', [QuestionController::class, 'import'])->name('import');
// edit course
Route::match(['get', 'head'], '/editCourse/{id}', [QuestionController::class, 'editCourse'])->name('editCourse');
// update course
Route::put('/updateCourse/{id}', [QuestionController::class, 'updateCourse'])->name('updateCourse');
// delete route
Route::match(['get', 'head'], 'deleteCourse/{id}', [QuestionController::class, 'deleteCourse'])->name('deleteCourse');
Route::match(['get', 'head'], '/export-users', [QuestionController::class, 'exportUsers'])->name('export-users');
Auth::routes();


// featured
Route::match(['get', 'head'], 'allFeatured', [BookController::class, 'allFeatured'])->name('allFeatured');
// top downloaders
Route::match(['get', 'head'], 'topDownloaders', [BookController::class, 'topDownloaders'])->name('topDownloaders');
Route::match(['get', 'head'], 'topDownloaders/mock', [mockController::class, 'topDownloaders'])->name('topDownloaders.mock');

// all books
Route::match(['get', 'post'], 'all-Books', [BookController::class, 'AllBooks'])->name('books.all');
Route::match(['get', 'post'], 'ajexBooks', [BookController::class, 'ajexBooks'])->name('books.ajex');
Route::match(['get', 'head'], 'BookDetail/{books:slug}', [BookController::class, 'BookDetail'])->name('books.detail');
Route::match(['get', 'head'], 'countShare/{id}', [BookController::class, 'countShare'])->name('books.countShare');
// all mocks
Route::match(['get', 'post'], 'all-Mocks', [mockController::class, 'AllMocks'])->name('mocks.all');
Route::match(['get', 'post'], 'ajexMocks', [mockController::class, 'ajexMocks'])->name('mocks.ajex');
Route::match(['get', 'head'], 'MockDetail/{mocks:slug}', [mockController::class, 'MockDetail'])->name('mocks.detail');
Route::match(['get', 'head'], 'MockcountShare/{id}', [mockController::class, 'countShare'])->name('mocks.countShare');

Route::match(['get', 'head'], 'checkQuestion/{id}', [QuestionController::class, 'checkQuestion'])->name('checkQuestion');
Route::post('subscribe/add', [ClientController::class, 'AddSubscribe'])->name('AddSubscribe');
// admin
Route::prefix('Sultan')->middleware('auth')->group(function () {
    Route::match(['get', 'head'], '/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::delete('coutactus/delete/{id}', [ClientController::class, 'delete'])->name('contactus.delete');
    Route::match(['get', 'head'], '/Books/add', function () {
        return view('admin.books.create');
    })->name('admin.books.create');
    Route::get('pdf/book/explanation/{id}', [App\Http\Controllers\HomeController::class, 'bookExplanation'])->name('pdfExp.book');
    Route::get('pdf/mock/explanation/{id}', [App\Http\Controllers\HomeController::class, 'mockExplanation'])->name('pdfExp.mock');

    Route::post('/Books/upload', [QuestionController::class, 'import'])->name('admin.books.upload');
    // Route::match(['get','head'],'/Books',[App\Http\Controllers\HomeController::class, 'index'])->name('admin.books.index');
    Route::resource('Book', BookController::class);
    Route::match(['get', 'head'], 'Book/softDelete/{id}', [BookController::class, 'softDelete'])->name('Book.softdelete');
    Route::resource('Mock', mockController::class);
    Route::match(['get', 'head'], 'Mock/softDelete/{id}', [mockController::class, 'softDelete'])->name('Mock.softdelete');

    Route::resource('category', categoryController::class);
    Route::match(['get', 'head'], 'category/softDelete/{id}', [categoryController::class, 'softDelete'])->name('category.softdelete');

    Route::resource('questionBank', questionBankController::class);
    Route::match(['get', 'head'], 'questionBank/softDelete/{id}', [questionBankController::class, 'softDelete'])->name('questionBank.softdelete');

    Route::match(['get', 'head'], 'users', [ClientController::class, 'viewClient'])->name('users');
    Route::match(['get', 'head'], 'subscribe/view', [ClientController::class, 'view_Subscribes'])->name('viewSubscribe');

    Route::match(['get', 'head'], 'contacts', [ClientController::class, 'viewContact'])->name('contacts');
});
