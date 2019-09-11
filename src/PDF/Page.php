<?php

namespace Leadout\Reports\PDF;

use Illuminate\Support\Collection;
use Leadout\Reports\PDF\Elements\Contract;
use setasign\Fpdi\Fpdi;

class Page
{
    /**
     * The elements in the page.
     *
     * @var Collection
     */
    private $elements;

    /**
     * Instantiate the page.
     *
     * @param $elements
     */
    public function __construct($elements)
    {
        $this->elements = collect($elements);
    }

    public static function make($elements)
    {
        return new Page($elements);
    }

    /**
     * Render the page onto the given PDF.
     *
     * @param Fpdi $pdf the PDF.
     * @return void
     */
    public function render($pdf)
    {
        $this->elements->each(function($element) use ($pdf){
            /** @var Contract $element */
            $element->render($pdf);
        });
    }
}
