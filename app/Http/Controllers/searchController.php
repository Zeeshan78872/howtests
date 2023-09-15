<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book;
use App\Models\mock;

class searchController extends Controller
{
    //
    public function search(Request $request)
    {
        $queryBook = book::query();
        $queryMock = mock::query();
        if ($request->isMethod('post')) {
            $search = $request->all();

            if (isset($search['author'])) {
                $author = $request->author;
                $queryBook = $queryBook->orWhere('author', 'like', '%' . $author . '%');
                $queryMock = $queryMock->orWhere('author', 'like', '%' . $author . '%');
            }
            if (isset($search['Keyword'])) {
                $Keyword = $request->Keyword;
                $author = $request->author;
                $queryBook = $queryBook->orWhere('title', 'like', '%' . trim($Keyword) . '%');
                $queryBook = $queryBook->whereRaw("FIND_IN_SET('$Keyword', meta_Keywords) > 0");
                $queryMock = $queryMock->orWhere('title', 'like', '%' . trim($Keyword) . '%');
                $queryMock = $queryMock->whereRaw("FIND_IN_SET('$Keyword', meta_Keywords) > 0");
            }
            if (isset($search['title'])) {
                $title = $request->title;
                $author = $request->author;
                $queryBook = $queryBook->orWhere('title', 'like', '%' . $title . '%');
                $queryMock = $queryMock->orWhere('title', 'like', '%' . $title . '%');
            }
            $BookCount = $queryBook->get()->count();
            $MockCount = $queryMock->get()->count();
            if (isset($search['currentCountMock'])) {
                $currentCountMock = $request->currentCountMock;
                $queryMock = $queryMock->limit($currentCountMock);
            } else {
                $queryMock = $queryMock->limit(8);
            }
            if (isset($search['currentCountBook'])) {
                $currentCountBook = $request->currentCountBook;
                $queryBook = $queryBook->limit($currentCountBook);
            } else {
                $queryBook = $queryBook->limit(8);
            }
            $not_Result = 1;
        } else {
            $search = null;
            $BookCount = $queryBook->get()->count();
            $MockCount = $queryMock->get()->count();
            $not_Result = 0;
        }
        $books = $queryBook->get();
        $mocks = $queryMock->get();

        if ($request->ajax()) {
            return response()->json([
                'books' => $books,
                'mocks' => $mocks,
                'BookCount' => $BookCount,
                'MockCount' => $MockCount,
                'search' => $search
            ]);
        } else {
            return view('searchby', compact('books', 'mocks', 'not_Result', 'BookCount', 'MockCount', 'search'));
        }
        // dd($books, $mocks, $BookCount, $MockCount);
    }
}
