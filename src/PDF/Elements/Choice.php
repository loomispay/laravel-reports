<?php

namespace Leadout\Reports\PDF\Elements;

use setasign\Fpdi\Fpdi;

class Choice
{
    /**
     * The value of the choice.
     *
     * @var string
     */
    private $value;

    /**
     * The X coordinate of the choice on the page.
     *
     * @var float
     */
    private $x;

    /**
     * The Y coordinate of the choice on the page.
     *
     * @var float
     */
    private $y;

    /**
     * Instantiate the class and set the properties.
     *
     * @param string $value the value of the choice.
     * @param float  $x     the X coordinate of the choice on the page.
     * @param float  $y     the Y coordinate of the choice on the page.
     */
    public function __construct($value, $x, $y)
    {
        $this->value = $value;

        $this->x = $x;

        $this->y = $y;
    }

    /**
     * Instantiate a new choice.
     *
     * @param string $value the value of the choice.
     * @param float  $x     the X coordinate of the choice on the page.
     * @param float  $y     the Y coordinate of the choice on the page.
     * @return Choice the new choice.
     */
    public static function make($value, $x, $y)
    {
        return new static($value, $x, $y);
    }

    /**
     * Render this choice onto the given PDF.
     *
     * @param FPDI  $pdf    the PDF.
     * @param array $values the values that are chosen in the parent checkbox.
     * @return void
     */
    public function render($pdf, $values)
    {
        $pdf->Image($this->getPath($values), $this->getX(), $this->getY(), $this->getWidth(), $this->getHeight());
    }

    private function getPath($values)
    {
        return '../../../img/' . (in_array($this->value, $values, true) ? 'checked-new.png' : 'unchecked-new.png');
    }

    private function getX()
    {
        return $this->x;
    }

    private function getY()
    {
        return $this->y;
    }

    private function getWidth()
    {
        return 3.5;
    }

    private function getHeight()
    {
        return 3.5;
    }
}
