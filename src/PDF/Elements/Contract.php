<?php

namespace Leadout\Reports\PDF\Elements;

use FPDI;

interface Contract
{
    /**
     * Render the element onto the given PDF.
     *
     * @param FPDI $pdf the PDF.
     * @return void
     */
    public function render($pdf);
}
