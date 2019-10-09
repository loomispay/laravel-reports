<?php

namespace Leadout\Reports\Excel;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Sheet implements FromArray, WithTitle, WithEvents, ShouldAutoSize
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
     * The colors in the sheet.
     *
     * @var Collection
     */
    private $colors;

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

        $this->colors = collect();
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

    /**
     * Register the events for the sheet.
     *
     * @return array the sheets.
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $this->colors->each(function ($color) use ($event) {
                    /** @var CellColor $color */
                    if ($color->getColor()) {
                        $event->sheet->getDelegate()->getStyle($color->getRange())
                            ->getFill()
                            ->setFillType(Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setARGB($color->getColor());
                    }

                    if ($color->getTextColor()) {
                        $event->sheet->getDelegate()->getStyle($color->getRange())
                            ->getFont()
                            ->getColor()
                            ->setARGB($color->getTextColor());
                    }
                });
            }
        ];
    }

    /**
     * Add the given color to the sheet.
     *
     * @param CellColor $color the color.
     * @return $this
     */
    public function addColor($color)
    {
        $this->colors->push($color);

        return $this;
    }

    /**
     * Set the colors in the sheet.
     *
     * @param Collection $colors the colors.
     * @return $this
     */
    public function setColors($colors)
    {
        $this->colors = $colors;

        return $this;
    }
}
