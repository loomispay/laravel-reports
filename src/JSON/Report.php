<?php

namespace Leadout\Reports\JSON;

use Leadout\Reports\Formats\Report as BaseReport;
use Illuminate\Support\Collection;

class Report extends BaseReport
{
    /**
     * The data for the report.
     *
     * @var array|Collection
     */
    private $data;

    /**
     * Instantiate the class and set the properties.
     *
     * @param array|Collection $data the data for the report.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Make a new JSON report.
     *
     * @param array|Collection $data the data for the report.
     * @return Report the report.
     */
    public static function make($data)
    {
        return new Report($data);
    }

    /**
     * Get the output of the report.
     *
     * @return string the output.
     */
    public function output()
    {
        return collect(['data' => $this->data])->toJson();
    }

    /**
     * Get the MIME type of the report.
     *
     * @return string the MIME type.
     */
    public function mimeType()
    {
        return 'application/json';
    }
}
