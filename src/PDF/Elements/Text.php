<?php

namespace Leadout\Reports\PDF\Elements;

use setasign\Fpdi\Fpdi;

class Text implements Contract
{
    /**
     * The content of the text field.
     *
     * @var string
     */
    private $content;

    /**
     * The leftmost x coordinate of the text.
     *
     * @var int
     */
    private $x;

    /**
     * The topmost y coordinate of the text.
     *
     * @var int
     */
    private $y;

    /**
     * The width of the text.
     *
     * @var int
     */
    private $width;

    /**
     * The height of the text.
     *
     * @var int
     */
    private $height;

    /**
     * The alignment of the text.
     *
     * @var string
     */
    private $align;

    /**
     * Instantiate the text.
     *
     * @param string $content the content of the text field.
     * @param int    $x       the leftmost x coordinate of the text.
     * @param int    $y       the topmost y coordinate of the text.
     * @param int    $width   the width of the text.
     * @param int    $height  the height of the text.
     * @param string $align   the alignment of the text.
     */
    public function __construct($content, $x, $y, $width = 0, $height = 0, $align = '')
    {
        $this->content = $content;

        $this->x = $x;

        $this->y = $y;

        $this->width = $width;

        $this->height = $height;

        $this->align = $align;
    }

    /**
     * Make a new text.
     *
     * @param string $content the content of the text field.
     * @param int    $x       the leftmost x coordinate of the text.
     * @param int    $y       the topmost y coordinate of the text.
     * @param int    $width   the width of the text.
     * @param int    $height  the height of the text.
     * @param string $align   the alignment of the text.
     * @return Text the text.
     */
    public static function make($content, $x, $y, $width = 0, $height = 0, $align = '')
    {
        return new Text($content, $x, $y, $width, $height, $align);
    }

    /**
     * Center align the text.
     *
     * @return $this
     */
    public function center()
    {
        $this->align = 'C';

        return $this;
    }

    /**
     * Right align the text.
     *
     * @return $this
     */
    public function right()
    {
        $this->align = 'R';

        return $this;
    }

    /**
     * Render the element onto the given PDF.
     *
     * @param Fpdi $pdf the PDF.
     * @return void
     */
    public function render($pdf)
    {
        $pdf->SetXY($this->x, $this->y);

        $pdf->Multicell($this->width, $this->height, utf8_decode($this->content), false, $this->align);
    }
}
