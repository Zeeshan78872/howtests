<?php

use App\Models\book;
use App\Models\mock;
use App\Models\category;
use App\Models\question;

use Dompdf\Dompdf; // Import the Dompdf class
use Dompdf\Options;
use Dompdf\FontMetrics;
use Dompdf\Frame;
use Illuminate\Support\Facades\Response;

use Spatie\Browsershot\Browsershot;




function MockGenerate($id)
{
    $mocks = mock::with(['category' => function ($query) {
        $query->where('delete', 0);
    }])->find($id);
    $categories = $mocks->category;
    $QuestionContent = '';
    $AnswerContent = '';

    $mock_wise = 1;
    $globalQuestionNum = 1;
    $aglobalQuestionNum = 1;


    foreach ($categories as $chapterNumber => $category) {
        $chapterQuestions = question::where('delete', 0)->where('category_id', $category->category_id)
            ->inRandomOrder()->take($category->select_question)->get();
        $cat_name = category::find($category->category_id);
        // for question
        $QuestionContent .= '<div style="page-break-before: always;" id="chapter_"> <div class="header-container">
                <div style="margin-bottom:10px;" class="header-content">
                    ' . $cat_name->name . '
                </div>
                <div class="header-link">';
        $QuestionContent .= '
                </div> ';
        $db = 'Q';
        $QuestionContent .= '</div>

        ' . view('pdf_template', compact('chapterQuestions', 'db', 'mock_wise', 'globalQuestionNum', 'chapterNumber'))->render() . '

        </div>';
        $globalQuestionNum += count($chapterQuestions);
        //  for answer

        $AnswerContent .= '<div style="page-break-before: always;" id="chapter_"> <div class="header-container">
        <div style="margin-bottom:10px;" class="header-content">
            ' . $cat_name->name . '
        </div>
        <div class="header-link">';
        $AnswerContent .= '
        </div> ';
        $AnswerContent .= '</div>
' . view('Answer_pdf_template', compact('chapterQuestions', 'mock_wise', 'aglobalQuestionNum', 'chapterNumber'))->render() . '</div>';
        $aglobalQuestionNum += count($chapterQuestions);
    }

    generatePDFMock($mocks->id, $mocks->title_image, $mocks->extra_image, $QuestionContent, 'Q', $mocks->title);
    generatePDFMock($mocks->id, $mocks->title_image, $mocks->extra_image, $AnswerContent, 'QWA', $mocks->title);
}
function generatePDFMock($id, $title_img, $extra_image, $Content, $db, $title)
{
    $imagePath = public_path('images/mock/' . $title_img);
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageUri = 'data:image/jpeg;base64,' . $imageData;

    $imagePathExtra = public_path('images\mockextraimage\\' . $extra_image);
    $imageDataextra = base64_encode(file_get_contents($imagePathExtra));
    $imageUriextra = 'data:image/jpeg;base64,' . $imageDataextra;
    $pdfHtml = '<html><head>
            <style>   .header-container {
                display: table;
                width: 100%;
            }
            .img-container{
                display: table;
                width: 100%;
            }
            .img-container {
                position: relative;
                width: 100%;
                height: 100vh; /* Set the height of the first page */
                overflow: hidden;
            }
            .img-content {
                position: absolute;
                top: 0;
                left: 0;
                width: 90%;
                height: 96%;
                margin-bottom:90px;
                background-image: url("' . $imageUri . '");
                background-size: contain; /* Change this to contain for a smaller image */
                background-repeat: no-repeat;
                background-position: center center;
                z-index: -1;
            }
            .img-extra{
                // position: absolute;
                // top: 0;
                // left: 0;
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                background-image: url("' . $imageUriextra . '");
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center center;
                z-index: -1;
            }
            .img-content {
                display: table-cell;
            }
            .header-content {
                display: table-cell;
            }
            .header-link {
                display: table-cell;
                text-align: right;
            }
            </style>
            </head><body>

            <div class="img-container">
            <div class="img-content"></div>
        </div>
        <div class="img-extra">
        </div>
            '  . $Content . '</body></html>';

    $pdf = new Dompdf();

    $pdf->loadHtml($pdfHtml);
    $pdf->set_option('isPhpEnabled', true);
    $pdf->set_option('copyDefaultProtection', ['copy']);
    $pdf->set_option('permissions', ['copy']);
    $pdf->render();
    // Replace the page numbers in the PDF with the actual page numbers

    // $pdf->stream('questions.pdf');
    $canvas = $pdf->getCanvas();
    $pageCount = $canvas->get_page_count();
    $mock = mock::find($id);
    $mock->page_count = $pageCount;
    $mock->update();
    if ($db == 'Q') {
        $pdfFilename = $title . $id . '.pdf';
        $pdfPath = public_path('pdfMock/Question/' . $pdfFilename);
    } else {
        $pdfFilename = $title . '_answer_' . $id . '.pdf';
        $pdfPath = public_path('pdfMock/QuestionWA/' . $pdfFilename);
    }

    file_put_contents($pdfPath, $pdf->output());
}

function BookGenerate($id)
{
    $files = Book::with(['category' => function ($query) {
        $query->where('delete', 0);
    }])->find($id);

    $downloads = $files->downloads;
    $files->downloads = $downloads + 5;
    $files->update();
    $categories = $files->category;
    //  dd($categories);
    $questions = question::where('delete', 0)->get();

    $questionsPerChapter = $files->question_per_ch;
    $img = $files->title_image;
    // Calculate the number of chapters
    $totalQuestions = $questions->count();

    // Organize the questions into chapters
    $chapters = $categories->count();
    $imagePath = public_path('images/' . $files->title_image);
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageUri = 'data:image/jpeg;base64,' . $imageData;
    $ContentCh = 1;
    $chapterPages = [];
    foreach ($categories as $chapterNumber => $category) {
        $chapterGroupQuestions = question::where('delete', 0)->where('category_id', $category->category_id)
            ->inRandomOrder()
            ->take($category->select_question)
            ->get()
            ->chunk(10);
        foreach ($chapterGroupQuestions as $index => $chapterQuestions) {
            $chapterPages[] = $ContentCh + 1;
            $ContentCh++;
        }
    }

    $questionQuery = question::query();
    $questionQuery = $questionQuery->where('delete', 0);
    $tableOfContents = view('table_of_contents', compact('categories', 'questionQuery', 'chapterPages', 'files'))->render();

    $QuestionContent = '';
    $AnswerContent = '';
    // questions
    // if ($db != 'AWE') {

    $mock_wise = 0;
    $chap = 1;
    $Gbobl_Chap_num = 0;
    foreach ($categories as $chapterNumber => $category) {
        $chapterGroupQuestions = question::where('delete', 0)->where('category_id', $category->category_id)
            ->inRandomOrder()
            ->take($category->select_question)
            ->get()->chunk(10);
        $cat_name = category::find($category->category_id);
        foreach ($chapterGroupQuestions as $index => $chapterQuestions) {
            // dd($chapterQuestions);
            $chapterQuestions = $chapterQuestions;
            // for question
            $QuestionContent .= '<div style="page-break-before: always;" id="chapter_' . ($chapterNumber + 1) . '"> <div class="header-container">
                <div class="header-content">
                    ' . $cat_name->name . ' / Advance Level # ' . ($index + 1) . '
                </div>
                <div class="header-link">';
            $QuestionContent .= '<a style="color: #5050ff;font-size:13px;" href="#index">Index</a>
                </div> ';
            $db = 'Q';
            $QuestionContent .= '</div>
                <h1 class="">Test' . ($chapterNumber + 1) . '</h1>
                ' . view('pdf_template', compact('chapterQuestions', 'db', 'mock_wise', 'chapterNumber'))->render() . '</div>';
            // $chap++;

            // for answer
            $AnswerContent .= '<div style="page-break-before: always;" id="chapter_' . ($chapterNumber + 1) .  '"> <div class="header-container">
                <div class="header-content">
                    ' . $cat_name->name . ' / Advance Level # ' . ($index + 1) . '
                </div>
                <div class="header-link">';
            $AnswerContent .= '<a style="color: #5050ff;font-size:13px;" href="#index">Index</a>
                </div> ';
            $AnswerContent .= '</div>
                <h1 class="">Test' . ($chapterNumber + 1) . '</h1>
                ' . view('Answer_pdf_template', compact('chapterQuestions',  'mock_wise', 'chapterNumber'))->render() . '</div>';
            $chap++;
        }
    }
    generatePDFBook($files->id, $files->title_image, $files->extra_image, $tableOfContents, $QuestionContent, 'Q', $chapterPages, $files->title);
    generatePDFBook($files->id, $files->title_image, $files->extra_image, $tableOfContents, $AnswerContent, 'QWA', $chapterPages, $files->title);
}

function generatePDFBook($id, $title_img, $extra_image, $tableOfContents, $Content, $db, $chapterPages, $title)
{

    $imagePath = public_path('images/' . $title_img);
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageUri = 'data:image/jpeg;base64,' . $imageData;
    $imagePathExtra = public_path('images\extraimage\\' . $extra_image);
    $imageDataextra = base64_encode(file_get_contents($imagePathExtra));
    $imageUriextra = 'data:image/jpeg;base64,' . $imageDataextra;
    $pdfHtml = '<html><head>
    <style>   .header-container {
        display: table;
        width: 100%;
            }
    .test{
        font-size:11px;
        font-family: Arial, Helvetica, sans-serif;
        font-style: italic;
        color: #000078;
    }
    .header-content {
        font-size:12px;
        font-family: Arial, Helvetica, sans-serif;

        display: table-cell;
    }
    .img-container{
        display: table;
        width: 100%;
    }
    .img-container {
        position: relative;
        width: 100%;
        height: 100vh; /* Set the height of the first page */
        overflow: hidden;
    }

    .img-content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        margin-bottom:90px;
        background-image: url("' . $imageUri . '");
        background-size: contain; /* Change this to contain for a smaller image */
        background-repeat: no-repeat;
        background-position: center center;
        z-index: -1;
    }
    .img-extra{
        // position: absolute;
        // top: 0;
        // left: 0;
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-image: url("' . $imageUriextra . '");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        z-index: -1;
    }
    .img-content {
        display: table-cell;
    }
    .header-link {
        display: table-cell;
        text-align: right;
    }
    </style>
    </head><body>
    <div class="img-container">
        <div class="img-content">
        </div>
    </div>
    <div class="img-extra">
    </div>'
        . $tableOfContents . $Content . '</body></html>';

    $pdf = new Dompdf();
    $pdf->loadHtml($pdfHtml);
    $canvas = $pdf->getCanvas();
    $pageCount = $canvas->get_page_count();

    $pdf->render();
    // Replace the page numbers in the PDF with the actual page numbers
    foreach ($chapterPages as $chapterNumber => $pageNumber) {
        $pdf->getCanvas()->page_text(550, 800, "Page " . $pageNumber, null, 10, [0, 0, 0]);
    }
    // $pdf->stream('questions.pdf');
    $canvas = $pdf->getCanvas();
    $pageCount = $canvas->get_page_count();
    $book = book::find($id);
    $book->page_count = $pageCount;
    $book->update();
    if ($db == 'Q') {
        $pdfFilename = $title . $id . '.pdf';
        $pdfPath = public_path('pdf/Question/' . $pdfFilename);
    }
    if ($db == 'QWA') {
        $pdfFilename = $title . '_answer_' . $id . '.pdf';
        $pdfPath = public_path('pdf/QuestionWA/' . $pdfFilename);
    }
    file_put_contents($pdfPath, $pdf->output());
}
// This is for mock explanation
function mockPdfExplanation($id)
{
    $mocks = mock::with(['category' => function ($query) {
        $query->where('delete', 0);
    }])->find($id);
    $categories = $mocks->category;
    $QuestionContent = '';
    $AnswerContent = '';

    $mock_wise = 1;
    $aglobalQuestionNum = 0;


    foreach ($categories as $chapterNumber => $category) {
        $chapterQuestions = question::where('delete', 0)->where('category_id', $category->category_id)
            ->inRandomOrder()->take($category->select_question)->get();
        $cat_name = category::find($category->category_id);

        //  for answer
        $AnswerContent .= '<div style="page-break-before: always;" id="chapter_"> <div class="header-container">
        <div style="margin-bottom:10px;" class="header-content">
            ' . $cat_name->name . '
        </div>
        <div class="header-link">';
        $AnswerContent .= '
        </div> ';
        $db = 'AWE';
        $AnswerContent .= '</div>
' . view('Answer_pdf_template', compact('chapterQuestions', 'mock_wise', 'aglobalQuestionNum', 'chapterNumber', 'db'))->render() . '</div>';
        $aglobalQuestionNum += count($chapterQuestions);
    }

    $imagePath = public_path('images/mock/' . $mocks->title_image);
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageUri = 'data:image/jpeg;base64,' . $imageData;
    $imagePathExtra = public_path('images\mockextraimage\\' . $mocks->extra_image);
    $imageDataextra = base64_encode(file_get_contents($imagePathExtra));
    $imageUriextra = 'data:image/jpeg;base64,' . $imageDataextra;
    $pdfHtml = '<html><head>
            <style>   .header-container {
                display: table;
                width: 100%;
            }
            .img-container{
                display: table;
                width: 100%;
            }
            .img-container {
                position: relative;
                width: 100%;
                height: 100vh; /* Set the height of the first page */
                overflow: hidden;
            }
            .img-content {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                margin-bottom:90px;
                background-image: url("' . $imageUri . '");
                background-size: contain; /* Change this to contain for a smaller image */
                background-repeat: no-repeat;
                background-position: center center;
                z-index: -1;
            }
            .img-extra{
                // position: absolute;
                // top: 0;
                // left: 0;
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                background-image: url("' . $imageUriextra . '");
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center center;
                z-index: -1;
            }
            .img-content {
                display: table-cell;
            }
            .header-content {
                display: table-cell;
            }
            .header-link {
                display: table-cell;
                text-align: right;
            }
            </style>
            </head><body>
            <div class="img-container">
            <div class="img-content"></div>
        </div>
        <div class="img-extra">
        </div>
            '  . $AnswerContent . '</body></html>';

    $pdf = new Dompdf();

    $pdf->loadHtml($pdfHtml);
    $pdf->set_option('isPhpEnabled', true);
    $pdf->set_option('copyDefaultProtection', ['copy']);
    $pdf->set_option('permissions', ['copy']);
    $pdf->render();
    // Replace the page numbers in the PDF with the actual page numbers

    $pdf->stream($mocks->title . '_explanation_' . $mocks->id . '.pdf');
}

// This is for book explanation
function pdfExplanation($id)
{
    $files = Book::with(['category' => function ($query) {
        $query->where('delete', 0);
    }])->find($id);
    // dd($files);
    $downloads = $files->downloads;
    $files->downloads = $downloads + 5;
    $files->update();
    $categories = $files->category;
    //  dd($categories);
    $questions = question::where('delete', 0)->get();

    $questionsPerChapter = $files->question_per_ch;
    $img = $files->title_image;
    // Calculate the number of chapters
    $totalQuestions = $questions->count();

    // Organize the questions into chapters
    $chapters = $categories->count();
    $imagePath = public_path('images/' . $files->title_image);
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageUri = 'data:image/jpeg;base64,' . $imageData;
    $imagePathExtra = public_path('images\extraimage\\' . $files->extra_image);
    $imageDataextra = base64_encode(file_get_contents($imagePathExtra));
    $imageUriextra = 'data:image/jpeg;base64,' . $imageDataextra;
    $ContentCh = 1;
    $chapterPages = [];
    foreach ($categories as $chapterNumber => $category) {
        $chapterGroupQuestions = question::where('delete', 0)->where('category_id', $category->category_id)
            ->inRandomOrder()
            ->take($category->select_question)
            ->get()
            ->chunk(10);
        foreach ($chapterGroupQuestions as $index => $chapterQuestions) {
            $chapterPages[] = $ContentCh + 1;
            $ContentCh++;
        }
    }

    $questionQuery = question::query();
    $questionQuery = $questionQuery->where('delete', 0);
    $tableOfContents = view('table_of_contents', compact('categories', 'questionQuery', 'chapterPages', 'files'))->render();

    $QuestionContent = '';
    $AnswerContent = '';
    // questions
    // if ($db != 'AWE') {

    $mock_wise = 0;
    $chap = 1;
    $Gbobl_Chap_num = 0;
    foreach ($categories as $chapterNumber => $category) {
        $chapterGroupQuestions = question::where('delete', 0)->where('category_id', $category->category_id)
            ->inRandomOrder()
            ->take($category->select_question)
            ->get()->chunk(10);
        $cat_name = category::find($category->category_id);
        foreach ($chapterGroupQuestions as $index => $chapterQuestions) {
            $chapterQuestions = $chapterQuestions;
            // for answer
            $AnswerContent .= '<div style="page-break-before: always;" id="chapter_' . ($chapterNumber + 1) . ($index + 1)  . '"> <div class="header-container">
                <div class="header-content">
                    ' . $cat_name->name . ' / Advance Level # ' . ($index + 1) . '
                </div>
                <div class="header-link">';
            $AnswerContent .= '<a style="color: #5050ff;font-size:13px;" href="#index">Index</a>
                </div> ';
            $db = 'AWE';
            $AnswerContent .= '</div>
                <h1 class="">Test' . ($chapterNumber + 1) . '</h1>
                ' . view('Answer_pdf_template', compact('chapterQuestions',  'mock_wise', 'chapterNumber', 'db'))->render() . '</div>';
            $chap++;
        }
    }

    $imagePath = public_path('images/' . $files->title_image);
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageUri = 'data:image/jpeg;base64,' . $imageData;

    $imagePathExtra = public_path('images\extraimage\\' . $files->extra_image);
    $imageDataextra = base64_encode(file_get_contents($imagePathExtra));
    $imageUriextra = 'data:image/jpeg;base64,' . $imageDataextra;
    $pdfHtml = '<html><head>
    <style>

    .header-container {
        display: table;
        width: 100%;
            }
    .test{
        font-size:11px;
        font-family: Arial, Helvetica, sans-serif;
        font-style: italic;
        color: #000078;
    }
    .header-content {
        font-size:12px;
        font-family: Arial, Helvetica, sans-serif;

        display: table-cell;
    }
    .img-container{
        display: table;
        width: 100%;
    }
    .img-container {
        position: relative;
        width: 100%;
        height: 100vh; /* Set the height of the first page */
        overflow: hidden;
    }

    .img-content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-image: url("' . $imageUri . '");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        z-index: -1;
    }

    .img-extra{
        // position: absolute;
        // top: 0;
        // left: 0;
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-image: url("' . $imageUriextra . '");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        z-index: -1;
    }

    .img-content,
    img-extra {
        display: table-cell;
    }
    .header-link {
        display: table-cell;
        text-align: right;
    }

    footer {
        position: fixed;
        bottom: -50px;
        left: 0px;
        right: 0px;
        height: 50px;
    }
    #footer span {
        display: inline-block; /* Make each span an inline-block element */
        margin: 0 10px; /* Add some spacing between elements */
      }

      .start {
        text-align: left; /* Align the site name to the left */
      }

      .middle {
        text-align: center; /* Align the author name to the center */
      }

      .end {
        text-align: right; /* Align the page number to the right */
      }
    .pagenum:before {
        content: counter(page);
    }
    </style>
    </head><body>

    <div class="img-container">
        <div class="img-content">
        </div>
    </div>
    <div class="img-extra">
    </div>
    <footer>
      <p id="footer" class="pagenum-container">
        <span style="margin-right: 24%;" class="start">howtest.com</span>
        <span style="margin-right: 24%;" class="middle">A Project by Sir Syed Kazim Ali</span>
        <span  class="end"><span class="pagenum"></span></span>
      </p>
</footer>
'
        . $tableOfContents . $AnswerContent . '</body>

    </html>';


    $options = new Options();
    $options->set('isPhpEnabled', 'true');
    $options->set('page-offset', 0);
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $pdf = new Dompdf($options);
    $pdf->loadHtml($pdfHtml);

    $pdf->render();

    // $font = $pdf->getFontMetrics()->get_font("helvetica", "bold");
    // $pdf->getCanvas()->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0, 0, 0));
    // Replace the page numbers in the PDF with the actual page numbers
    $totalPages = $pdf->getCanvas()->get_page_count();

    // Loop through each page to add page numbers
    for ($pageNumber = 1; $pageNumber <= $totalPages; $pageNumber++) {
        // Add a new page if it's not the first page
        // Set the page number as a text element
        $pageText = $pageNumber . ' of ' . $totalPages;
        $canvas = $pdf->getCanvas();
        $canvas->page_text(550, 800, "Page " . $pageText, null, 10, [1, 0, 0]);
    }
    foreach ($chapterPages as $chapterNumber => $pageNumber) {
        $pdf->getCanvas()->page_text(550, 800, "Page " . $pageNumber, null, 10, [1, 0, 0]);
    }
    // $watermarkText = 'howtests.com';
    // $font = $pdf->getFontMetrics()->get_font("helvetica", "bold");
    // // Set the watermark angle and opacity
    // $pdf->getCanvas()->rotate(-30, 300, 300);
    // $pdf->getCanvas()->set_opacity(0.1);

    // Add the watermark to the current page
    // $pdf->getCanvas()->page_text(100, 200, $watermarkText, $font, 36, array(192, 192, 192));
    $numPages  = $pdf->getCanvas()->get_page_count();
    for ($pageNumber = 1; $pageNumber <= $numPages; $pageNumber++) {
        // $canvas = $pdf->getDompdf()->getCanvas($pageNumber);
        $pagePdf = clone $pdf;

        // Get the canvas for the current page
        $canvas = $pagePdf->getCanvas($pageNumber);

        $text = "howtests.com";
        $height = $canvas->get_height();
        $width = $canvas->get_width();

        $canvas->set_opacity(.1);

        $x = ($width / 5);
        $y = ($height / 2);

        $canvas->text($x, $y, $text, 75, 75, [0, 0, 0], 0.0, 0.0, -30);
    }
    // $pdf->getCanvas()->page_text($x, $y, $text, 75, 75, array(192, 192, 100), 0.0, 0.0, -30);
    // $pdf->getCanvas()->set_opacity(0.1);

    $pdf->stream($files->title . '_explanation' . $id . '.pdf');


    // dd($pageCount);
}
