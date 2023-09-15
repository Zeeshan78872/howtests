<?php

use App\Models\book;
use App\Models\mock;
use App\Models\category;
use App\Models\question;

// use TCPDF;
use App\PDF\CustomTCPDF;


function book_pdf($id)
{
    $files = book::with(['category' => function ($query) {
        $query->where('delete', 0);
    }])->find($id);
    // dd($files);
    $downloads = $files->downloads;
    $files->downloads = $downloads + 5;
    $files->update();
    $categories = $files->category;
    $questionArray = [];
    foreach ($categories as $chapterNumber => $category) {
        $categoryQuestions = question::where('delete', 0)
            ->where('category_id', $category->category_id)
            ->inRandomOrder()
            ->take($category->select_question)
            ->get();
        $questionArray += [$category->category_id => $categoryQuestions->toArray()];
    }
    // dd($questionArray);
    pdf($files, $categories, 'book', 'Q', $questionArray);
    pdf($files, $categories, 'book', 'A', $questionArray);
    pdf($files, $categories, 'book', 'E', $questionArray);
}
function mock_pdf($id)
{
    $files = mock::with(['category' => function ($query) {
        $query->where('delete', 0);
    }])->find($id);
    // dd($files);
    $downloads = $files->downloads;
    $files->downloads = $downloads + 5;
    $files->update();
    $categories = $files->category;
    $questionArray = [];
    foreach ($categories as $chapterNumber => $category) {
        $categoryQuestions = question::where('delete', 0)
            ->where('category_id', $category->category_id)
            ->inRandomOrder()
            ->take($category->select_question)
            ->get();
        $questionArray += [$category->category_id => $categoryQuestions->toArray()];
    }
    // dd($questionArray);
    pdf($files, $categories, 'mock', 'Q', $questionArray);
    pdf($files, $categories, 'mock', 'A', $questionArray);
    pdf($files, $categories, 'mock', 'E', $questionArray);
}
function pdf($files, $categories, $pdf_type, $qst_type, $questionArray)
{
    $pdf = new CustomTCPDF();

    $pdf->SetProtection(['copy'], '', '');
    $pdf->SetPrintHeader(false);
    // Set PDF headers and footers (if needed)
    $pdf->SetHeaderData('', 0, 'My PDF Header', 'My PDF Footer');
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // set margins
    $pdf->SetMargins(10, 14, 10);
    // $pdf->SetPrintFooter(false);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->AddPage();
    $pdf->SetFont('times', '', 12);
    $bMargin = $pdf->getBreakMargin();
    $auto_page_break = $pdf->getAutoPageBreak();
    $pdf->SetAutoPageBreak(false, 0);
    // Title Image
    if ($pdf_type == 'book') {
        $titleImagePath1 = public_path('images/' . $files->title_image); // Replace with the actual path to your title image
    } else {
        $titleImagePath1 = public_path('images/mock/' . $files->title_image); // Replace with the actual path to your title image
    }
    $pdf->Image($titleImagePath1, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
    $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
    $pdf->setPageMark();
    if (isset($files->extra_image)) {
        // Disclaimer Image
        $pdf->AddPage();
        $pdf->SetFont('times', '', 12);
        $bMargin = $pdf->getBreakMargin();
        $auto_page_break = $pdf->getAutoPageBreak();
        $pdf->SetAutoPageBreak(false, 0);
        if ($pdf_type == 'book') {
            $titleImagePath2 = public_path('images/extraimage/' . $files->extra_image);
        } else {
            $titleImagePath2 = public_path('images/mockextraimage/' . $files->extra_image); // Replace with the actual path to your title image
        }
        $pdf->Image($titleImagePath2, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $pdf->setPageMark();
    }
    if (isset($files->extra_image_1)) {
        // Disclaimer Image
        $pdf->AddPage();
        $pdf->SetFont('times', '', 12);
        $bMargin = $pdf->getBreakMargin();
        $auto_page_break = $pdf->getAutoPageBreak();
        $pdf->SetAutoPageBreak(false, 0);
        if ($pdf_type == 'book') {
            $titleImagePath3 = public_path('images/extraimage/' . $files->extra_image_1);
        } else {
            $titleImagePath3 = public_path('images/mockextraimage/' . $files->extra_image_1); // Replace with the actual path to your title image
        }
        $pdf->Image($titleImagePath3, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $pdf->setPageMark();
    }
    // Loop through each question and its options
    foreach ($categories as $chapterNumber => $category) {
        $categoryQuestions = $questionArray[$category->category_id];
        $cat_name = category::find($category->category_id);
        // Divide the questions into groups of 5
        $questionGroups = array_chunk($categoryQuestions, 10);
        foreach ($questionGroups as $index => $chapterQuestions) {
            $pdf->AddPage();
            $secondpage_cat = $index;
            $titleImagePath = public_path('images/site/finalwatermark.png'); // Replace with the actual path to your title image
            $pdf->Image($titleImagePath, 0, 0, 0, 0, '', '', '', false, 300, '', false, false, 0);
            // $pdf->SetAlpha(1);
            if ($pdf_type == 'book') {
                if ($index == 0) {
                    $pdf->Bookmark($cat_name->name, 0, 0, '', 'B', array(0, 114, 201));
                }
                $pdf->Bookmark(('Level ' . $chapterNumber + 1) . '.' . ($index + 1), 1, 0, '', '', array(0, 114, 201));
            }
            if (isset($files->extra_image) && isset($files->extra_image_1)) {
                $index_page = 4;
            } elseif (isset($files->extra_image) || isset($files->extra_image_1)) {
                $index_page = 3;
            } else {
                $index_page = 2;
            }
            $pdf->SetLineStyle(array());
            $pdf->SetFont('times', '', 11);
            $y = $pdf->getY();
            $pdf->SetFillColor(255, 255, 255);
            $index_link = $pdf->AddLink();
            $pdf->SetLink($index_link, 0, '*' . $index_page);
            $pdf->setCellPaddings(0, 0, 0, 5);
            $pdf->SetX(15);
            $pdf->Cell(80, 0, $cat_name->name . ' / ' . 'Level #' . ($index + 1), 0, false, 'L');
            if ($pdf_type == 'book') {
                $pdf->SetX($pdf->getPageWidth() - 75);
                $pdf->Cell(0, 0, 'Index', 0, 0, 'R', false, $index_link);
            }
            $pdf->Ln();
            $pdf->SetTextColor(0, 0, 0);
            if ($pdf_type == 'book') {
                if ($index == 0) {
                    $pdf->SetFont('times', 'B', 20);
                    $pdf->setCellPaddings(7, 2, 0, 2);
                    $pdf->Cell(0, 10, $cat_name->name, 0, 1, 'L');
                }
            }
            $pdf->SetFont('times', '', 12);
            $index_link = $pdf->AddLink();
            $pdf->SetLink($index_link, 0, '*' . ($index + 1));
            $chapterQuestions = collect($chapterQuestions);
            if (!isset($series_qn) && $pdf_type == 'mock') {
                $series_qn = 0;
            }
            $y = $pdf->getY();
            $pageWidth = $pdf->getPageWidth();
            $contentWidth = $pageWidth - 20 - 20;
            $totalHeight = 0;
            $content = '';
            foreach ($chapterQuestions as $questionNum => $questionData) {
                if ($pdf_type == 'mock') {
                    $questionNum = $series_qn;
                }
                if ($questionNum % 2 != 0) {
                    $pdf->SetFillColor(240, 240, 240);
                } else {
                    $pdf->SetFillColor(255, 255, 255);
                }
                $pdf->SetFont('times', 'B', 11);
                // $pdf->MultiCell(0, 8, 'Q' . ($questionNum + 1) . '   ' . $questionData['question'], 0, 'T', true);
                $pdf->setCellPaddings(5, 1, 3, 2);
                $question = '  Q' . ($questionNum + 1) . '   ' . $questionData['question'];
                $content = $content . $question;
                $questionHeight = $pdf->getStringHeight($contentWidth, $question); // Adjust width and font settings

                $lines = explode("\n", wordwrap($question, 110, "\n", true)); // Adjust the width (80) as needed
                $pdf->setCellPaddings(3, 2, 3, 0);
                foreach ($lines as $index => $line) {
                    // Determine the alignment for each line
                    $alignment = ($index == 0) ? 'L' : 'T';
                    if ($index != 0) {
                        $line = str_repeat(' ', 11) . $line;
                    }
                    $pdf->setCellPaddings(0, 1, 3, 2);
                    $pdf->MultiCell(0, 2, $line, 0, $alignment, true);
                }
                $options = [
                    'a' => $questionData['opt_a'],
                    'b' => $questionData['opt_b'],
                ];
                if (isset($questionData['opt_c']) && !empty($questionData['opt_c'])) {
                    $options['c'] = $questionData['opt_c'];
                }
                if (isset($questionData['opt_d']) && !empty($questionData['opt_d'])) {
                    $options['d'] = $questionData['opt_d'];
                }
                $optionsText = implode("\n", $options);
                $optionsHeight = $pdf->getStringHeight($contentWidth, $optionsText);
                if ($qst_type != 'Q') {
                    $correctAnswer = strtolower($questionData['answer']); // Get the correct answer
                } else {
                    $correctAnswer = 'e'; // set for not show answer of question
                }
                $formattedOptions = [];
                $maxCellWidth = 150;
                $optionsPerLine = 0;
                $maxOptionsPerLine = 1;
                $horizontalSpacing = 5;
                $totalOptionsWidth = 0;
                foreach ($options as $key => $optionText) {
                    $optionWidth = $pdf->GetStringWidth(' (' . $key . ') ' . $optionText);
                    $totalOptionsWidth += $optionWidth;
                }
                if ($totalOptionsWidth <= $maxCellWidth) {
                    // All options fit within the maximum width, display them on the same line
                    $formattedOptions[] = '';
                    foreach ($options as $key => $optionText) {
                        $optionWidth = $pdf->GetStringWidth(' (' . $key . ') ' . $optionText);
                        if ($key === $correctAnswer) {
                            $formattedOptions[] = '<b> (' . $key . ') ' . $optionText . '</b>';
                        } else {
                            $formattedOptions[] = '(' . $key . ') ' . $optionText;
                        }
                        // $formattedOptions[] = '(' . $key . ') ' . $optionText;
                        if ($key !== 'd') {
                            if ($totalOptionsWidth <= 60) {
                                $horizontalSpacing = 30;
                            } elseif ($totalOptionsWidth <= 80) {
                                $horizontalSpacing = 25;
                            } elseif ($totalOptionsWidth <= 100) {
                                $horizontalSpacing = 15;
                            } elseif ($totalOptionsWidth <= 120) {
                                $horizontalSpacing = 12;
                            }
                            $formattedOptions[] = str_repeat('&nbsp;', $horizontalSpacing);
                        }
                    }
                    $formattedOptions[] = '';
                } else {
                    foreach ($options as $key => $optionText) {
                        $optionLines = []; // Array to hold lines for the current option
                        $currentLine = '';
                        foreach (str_split($optionText) as $character) {
                            $currentLine .= $character;
                            $lineWidth = $pdf->GetStringWidth('(' . $key . ') ' . $currentLine);
                            if ($lineWidth >= $maxCellWidth) {
                                $optionLines[] = '(' . $key . ') ' . $currentLine;
                                $currentLine = '';
                            }
                        }
                        if (!empty($currentLine)) {
                            $optionLines[] = '(' . $key . ') ' . $currentLine;
                        }
                        $optionFormatted = implode("\n", $optionLines);
                        if ($optionsPerLine >= $maxOptionsPerLine) {
                            $formattedOptions[] = "\n"; // Add a line break
                            $optionsPerLine = 0; // Reset the counter
                        }
                        if ($key === $correctAnswer) {
                            $formattedOptions[] = '<b>' . $optionFormatted . '</b>';
                        } else {
                            $formattedOptions[] = $optionFormatted;
                        }
                        $horizontalSpacing = 5;

                        $formattedOptions[] = str_repeat('&nbsp;', $horizontalSpacing);
                        $optionsPerLine++;
                        $optionsText = implode('', $formattedOptions);
                        $optionsWidth = $pdf->GetStringWidth($optionsText);
                        if ($optionsWidth <= $maxCellWidth) {
                            $maxOptionsPerLine++;
                        }
                    }
                }
                $optionsText = implode('', $formattedOptions);
                $optionsArray = explode("\n", $optionsText);
                $pdf->SetFont('times', '', 11); // Set to normal
                $pdf->setCellPaddings(12, 0, 5, 0);
                foreach ($optionsArray as $formattedOption) {
                    $content = $content . $formattedOption;
                    $pdf->setCellPaddings(9, 1, 5, 1);
                    $pdf->writeHTMLCell(0, 7, '', '', $formattedOption, 0, 1, true, true, 'L');
                }
                if ($qst_type == 'E' && isset($questionData['explanation'])) {
                    $question = '         Explanation:' . $questionData['explanation'];
                    $explanationHeight = $pdf->getStringHeight($contentWidth, $question); // Adjust width and font settings
                    $lines = explode("\n", wordwrap($question, 110, "\n", true)); // Adjust the width (80) as needed
                    $pdf->setCellPaddings(3, 2, 3, 0);
                    foreach ($lines as $index => $line) {
                        // Determine the alignment for each line
                        $alignment = ($index == 0) ? 'L' : 'T';
                        if ($index != 0) {
                            $line = str_repeat(' ', 9) . $line;
                        }
                        $pdf->setCellPaddings(0, 1, 3, 2);
                        $content = $content . $line;
                        $pdf->MultiCell(0, 2, $line, 0,  $alignment, true);
                    }
                } else {
                    $explanationHeight = 0;
                }
                $pdf->setCellPaddings(0, 0, 0, 0);
                $pdf->Ln(3);

                if ($pdf_type == 'mock') {
                    $series_qn++;
                }
                $questionBlockHeight = $questionHeight + $optionsHeight + $explanationHeight;
                // Update the total height
                $totalHeight += $questionBlockHeight;
                if ($qst_type == 'E') {
                    // $totalHeight = $elementHeight;
                    if (($totalHeight + $questionBlockHeight) / 2 > $pdf->getPageHeight() - 50) {
                        // If not, create a new page
                        // $content = '';
                        $pdf->AddPage();
                        $titleImagePath = public_path('images/site/finalwatermark.png'); // Replace with the actual path to your title image
                        $pdf->Image($titleImagePath, 0, 0, 0, 0, '', '', '', false, 300, '', false, false, 0);
                        $pdf->SetFont('times', '', 11);
                        $y = $pdf->getY();
                        $pdf->SetFillColor(255, 255, 255);
                        $index_link = $pdf->AddLink();
                        $pdf->SetLink($index_link, 0, '*' . $index_page);
                        $pdf->setCellPaddings(0, 0, 0, 5);
                        $pdf->SetX(15);
                        $pdf->Cell(80, 0, $cat_name->name . ' / ' . 'Level #' . ($secondpage_cat + 1), 0, false, 'L');
                        if ($pdf_type == 'book') {
                            $pdf->SetX($pdf->getPageWidth() - 75);
                            $pdf->Cell(0, 0, 'Index', 0, 0, 'R', false, $index_link);
                        }
                        $pdf->Ln();
                        $totalHeight = 0;
                    }
                    $totalHeight += $questionBlockHeight;
                }
            }
        }
    }
    $totalPageCount = $pdf->getPage();
    if ($pdf_type == 'book') {
        $pdf->setCellPaddings(0, 2, 0, 0);
        // add a new page for TOC
        $pdf->addTOCPage();
        $pdf->SetFont('timesI', 'B', 30);
        $pdf->SetTextColor(0, 0, 122); // Red color
        $pdf->MultiCell(0, 18, $files->title, 0, 'L', 0, 1, '', '', true, 0);
        $pdf->SetFont('times', '', 12);
        if (isset($files->extra_image) && isset($files->extra_image_1)) {
            $tocStart_page = 4;
        } elseif (isset($files->extra_image) || isset($files->extra_image_1)) {
            $tocStart_page = 3;
        } else {
            $tocStart_page = 2;
        }
        $pdf->addTOC($tocStart_page, 'courier', '.', 'INDEX', 'B', array(0, 0, 0));
        $pdf->endTOCPage();
    }
    if ($pdf_type == 'book') {
        if ($qst_type == 'Q') {
            $book = book::find($files->id);
            $book->page_count = $totalPageCount;
            $book->update();
            $pdf->Output(public_path('pdf/Question/' . $files->title . $files->id . '.pdf'), 'F');
        } elseif ($qst_type == 'A') {
            $pdf->Output(public_path('pdf/QuestionWA/' . $files->title . '_answer_' . $files->id . '.pdf'), 'F');
        } elseif ($qst_type == 'E') {
            $pdf->Output(public_path('pdf/explanation/' . $files->title . '_explanation_' . $files->id . '.pdf'), 'F');
        }
    } else {
        if ($qst_type == 'Q') {
            $mock = mock::find($files->id);
            $mock->page_count = $totalPageCount;
            $mock->update();
            $pdf->Output(public_path('pdfMock/Question/' . $files->title . $files->id . '.pdf'), 'F');
        } elseif ($qst_type == 'A') {
            $pdf->Output(public_path('pdfMock/QuestionWA/' . $files->title . '_answer_' . $files->id . '.pdf'), 'F');
        } elseif ($qst_type == 'E') {
            $pdf->Output(public_path('pdfMock/explanation/' . $files->title . '_explanation_' . $files->id . '.pdf'), 'F');
        }
    }
}
