<?php

namespace Leadout\Reports\Formats\Text;

use Leadout\Reports\Formats\DownloadableReport;

class Report extends DownloadableReport
{
    /**
     * The filename.
     *
     * @var string
     */
    private $filename;

    /**
     * The content of the report.
     *
     * @var string
     */
    private $content;

    /**
     * Instantiate the class and set the properties.
     *
     * @param string $filename the filename.
     * @param string $content  the content of the report.
     */
    public function __construct($filename, $content)
    {
        $this->filename = $filename;

        $this->content = $content;
    }

    /**
     * Make a new report.
     *
     * @param string $filename the filename.
     * @param string $content  the content of the report.
     * @return Report the report.
     */
    public static function make($filename, $content)
    {
        return new Report($filename, $content);
    }

    /**
     * Get the output of the report.
     *
     * @return string the output.
     */
    public function output()
    {
        return $this->content;
    }

    /**
     * Get the MIME type of the report.
     *
     * @return string the MIME type.
     */
    public function mimeType()
    {
        return 'text/plain';
    }

    /**
     * Get the filename of the report.
     *
     * @return string the filename.
     */
    public function filename()
    {
        return $this->filename . '.txt';
    }
}
