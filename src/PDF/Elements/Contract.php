<?php

namespace Leadout\Reports\PDF\Elements;

use setasign\Fpdi\Fpdi;

interface Contract
{
    /**
     * Render the element onto the given PDF.
     *
     * @param Fpdi $pdf the PDF.
     * @return void
     */
    public function render($pdf);
}
