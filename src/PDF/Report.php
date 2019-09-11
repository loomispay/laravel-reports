<?php

namespace Leadout\Reports\PDF;

use Illuminate\Support\Collection;
use Leadout\Reports\DownloadableReport;
use setasign\Fpdi\Fpdi;

class Report extends DownloadableReport
{
    private $filename;

    /**
     * The path to the source file.
     *
     * @var string
     */
    private $source;

    /**
     * The pages in the document.
     *
     * @var Collection
     */
    private $pages;

    /**
     * The font size of the document.
     *
     * @var int
     */
    private $fontSize = 10;

    public function __construct($filename, $source, $pages)
    {
        $this->filename = $filename;

        $this->source = $source;

        $this->pages = collect($pages);
    }

    public static function make($filename, $source, $pages)
    {
        return new Report($filename, $source, $pages);
    }

    /**
     * Get the PDF representation of the document.
     *
     * @return Fpdi the PDF representation.
     */
    public function getPDF()
    {
        $pdf = new Fpdi;

        $pdf->setSourceFile($this->source);

        //$pdf->setPrintHeader(false);

        $pdf->SetFontSize($this->fontSize);

        $this->render($pdf);

        return $pdf;
    }

    /**
     * Render the document onto the given PDF.
     *
     * @param Fpdi $pdf the PDF.
     * @return void
     */
    private function render($pdf)
    {
        $this->pages->each(function ($page, $index) use ($pdf) {
            $pdf->AddPage();

            $pdf->useTemplate($pdf->importPage($index + 1));

            $page->render($pdf);
        });
    }

    /**
     * Set the font size of the document.
     *
     * @param int $fontSize the font size.
     * @return $this
     */
    public function setFontSize($fontSize)
    {
        $this->fontSize = $fontSize;

        return $this;
    }

    /**
     * Get the filename of the report.
     *
     * @return string the filename.
     */
    public function filename()
    {
        return $this->filename;
    }

    /**
     * Get the output of the report.
     *
     * @return string the output.
     */
    public function output()
    {
        return $this->getPDF()->Output('', 'S');
    }

    /**
     * Get the MIME type of the report.
     *
     * @return string the MIME type.
     */
    public function mimeType()
    {
        return 'application/pdf';
    }
}
