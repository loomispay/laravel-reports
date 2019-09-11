<?php

namespace Leadout\Reports\Excel;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class Sheet implements FromArray, WithTitle
{
    /**
     * The title of the sheet.
     *
     * @var string
     */
    private $title;

    /**
     * The data in the sheet.
     *
     * @var Collection
     */
    private $data;

    /**
     * Instantiate the class and set the properties.
     *
     * @param string           $title the title of the sheet.
     * @param Collection|array $data  the data in the sheet.
     */
    public function __construct($title, $data)
    {
        $this->title = $title;

        $this->data = collect($data);
    }

    /**
     * Make a new sheet.
     *
     * @param string           $title the title of the sheet.
     * @param Collection|array $data  the data in the sheet.
     * @return Sheet the sheet.
     */
    public static function make($title, $data)
    {
        return new Sheet($title, $data);
    }

    /**
     * Get the title of the sheet.
     *
     * @return string the title.
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * Get the data in the sheet.
     *
     * @return array the data.
     */
    public function array(): array
    {
        return $this->data->toArray();
    }
}
