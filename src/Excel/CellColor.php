<?php

namespace Leadout\Reports\Excel;

class CellColor
{
    /**
     * The cell range.
     *
     * @var string
     */
    private $range;

    /**
     * The background color.
     *
     * @var string
     */
    private $color;

    /**
     * The text color.
     *
     * @var string
     */
    private $textColor;

    /**
     * Instantiate the cell.
     *
     * @return CellColor the cell.
     */
    public static function make()
    {
        return new CellColor;
    }

    /**
     * Get the cell range.
     *
     * @return string the cell range.
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * Set the cell range.
     *
     * @param string $range the range.
     * @return $this
     */
    public function setRange($range)
    {
        $this->range = $range;

        return $this;
    }

    /**
     * Get the background color.
     *
     * @return string the background color.
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the background color.
     *
     * @param string $color the color.
     * @return $this
     */
    public function setColor($color)
    {
        $this->color = ltrim($color, '#');

        return $this;
    }

    /**
     * Get the text color.
     *
     * @return string the text color.
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * Set the text color.
     *
     * @param string $textColor the text color.
     * @return $this
     */
    public function setTextColor($textColor)
    {
        $this->textColor = ltrim($textColor, '#');

        return $this;
    }
}