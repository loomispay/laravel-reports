<?php

namespace Leadout\Reports\Excel;

use Illuminate\Support\Collection;
use Leadout\Reports\DownloadableReport;

class Report extends DownloadableReport
{
    /**
     * The filename of the report.
     *
     * @var string
     */
    private $filename;

    /**
     * The sheets in the report.
     *
     * @var Collection
     */
    private $sheets;

    /**
     * Instantiate the class and set the properties.
     *
     * @param string           $filename the filename of the report.
     * @param Collection|array $sheets   the sheets in the report.
     */
    public function __construct($filename, $sheets)
    {
        $this->filename = $filename;

        $this->sheets = collect($sheets);
    }

    /**
     * Make a new report.
     *
     * @param string           $filename the filename of the report.
     * @param Collection|array $sheets   the sheets in the report.
     * @return Report the report.
     */
    public static function make($filename, $sheets)
    {
        return new Report($filename, $sheets);
    }

    /**
     * Get the output of the report.
     *
     * @return string the output.
     */
    public function output()
    {
        return (new Spreadsheet($this->sheets))->download($this->filename)->content();
    }

    /**
     * Get the MIME type of the report.
     *
     * @return string the MIME type.
     */
    public function mimeType()
    {
        return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    }

    /**
     * Get the filename of the report.
     *
     * @return string the filename.
     */
    public function filename()
    {
        return $this->filename . '.xlsx';
    }
}
