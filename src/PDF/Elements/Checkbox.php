<?php

namespace Leadout\Reports\PDF\Elements;

use setasign\Fpdi\Fpdi;

class Checkbox implements Contract
{
    /**
     * The values that the checkbox has.
     *
     * @var array
     */
    private $values;

    /**
     * The choices that this checkbox has.
     *
     * @var array
     */
    private $choices;

    /**
     * Instantiate the checkbox.
     *
     * @param mixed $values the values that the checkbox has.
     */
    public function __construct($values = null)
    {
        $this->values = is_array($values) ? $values : func_get_args();

        $this->choices = collect();
    }

    /**
     * Instantiate a new checkbox.
     *
     * @param mixed $values the values that the checkbox has.
     * @return Checkbox the new checkbox.
     */
    public static function make($values = null)
    {
        return new static(is_array($values) ? $values : func_get_args());
    }

    /**
     * Render the element onto the given PDF.
     *
     * @param FPDI $pdf the PDF.
     * @return void
     */
    public function render($pdf)
    {
        $this->choices->each->render($pdf, $this->values);
    }

    public function addChoice($value, $x, $y)
    {
        $this->choices->push(Choice::make($value, $x, $y));

        return $this;
    }
}
