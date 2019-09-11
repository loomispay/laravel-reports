<?php

namespace Leadout\Reports;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class Report implements Responsable
{
    /**
     * Get the output of the report.
     *
     * @return string the output.
     */
    abstract public function output();

    /**
     * Get the MIME type of the report.
     *
     * @return string the MIME type.
     */
    abstract public function mimeType();

    /**
     * Create an HTTP response that represents the object.
     *
     * @param Request $request the incoming request.
     * @return Response the response.
     */
    public function toResponse($request)
    {
        return Response::create($this->output())->header('Content-Type', $this->mimeType());
    }
}
