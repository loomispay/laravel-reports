<?php

namespace Leadout\Reports\Excel;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Spreadsheet implements WithMultipleSheets
{
    use Exportable;

    /**
     * The sheets in the spreadsheet.
     *
     * @var Collection
     */
    private $sheets;

    /**
     * Instantiate the class and set the properties.
     *
     * @param Collection|array $sheets the sheets in the spreadsheet.
     */
    public function __construct($sheets)
    {
        $this->sheets = $sheets;
    }

    /**
     * Get the sheets in the spreadsheet.
     *
     * @return array the sheets.
     */
    public function sheets(): array
    {
        return $this->sheets->toArray();
    }
}
