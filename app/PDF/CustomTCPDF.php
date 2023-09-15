<?php

namespace App\PDF;

use TCPDF;

class CustomTCPDF extends TCPDF
{
    private $startFooterPage = 3;
    // Override the Footer() method to customize the footer
    public function Footer()
    {

        if ($this->getPage() > $this->startFooterPage) {
            // $titleImagePath = public_path('images/site/finalwatermark.png'); // Replace with the actual path to your title image
            // $pageWidth = $this->getPageWidth();
            // $pageHeight = $this->getPageHeight();
            // list($imgWidth, $imgHeight) = getimagesize($titleImagePath);
            // $x = ($pageWidth - 20) / 2;
            // $y = ($pageHeight - 20) / 2;
            // $this->SetAlpha(0.1);
            // $this->Image($titleImagePath, $x, $y, 100, 100, '', '', '', false, 300, '', false, false, 0);
            // $this->SetAlpha(1);

            // $this->Image($titleImagePath, $x, $x, 100, $imgHeight);
            // Set the font for the footer
            $this->SetFont('helvetica', 'I', 8);
            // Set the position for the site name (left)
            $this->SetX(15);
            $this->Cell(60, 0, 'howtests.com', 0, false, 'L');

            // Set the position for the author (middle)
            $this->SetX($this->getPageWidth() / 2 - 30);
            $this->Cell(60, 0, 'A Project by Sir Syed Kazim Ali', 0, false, 'C');

            // Set the position for the page number (right)
            $this->SetX($this->getPageWidth() - 75);
            $this->Cell(60, 0, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, 0, 'R');
        } elseif ($this->getPage() === $this->startFooterPage) {
            // Hide footer from page 4 onwards
            // You can leave this block empty or add any other content as needed
        }
    }
}
