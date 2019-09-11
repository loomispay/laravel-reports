<?php

namespace Leadout\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class DownloadableReport extends Report
{
    /**
     * Get the filename of the report.
     *
     * @return string the filename.
     */
    abstract public function filename();

    /**
     * Get the content disposition.
     *
     * @return string the content disposition.
     */
    private function contentDisposition()
    {
        // TODO: is a semi colon an array?
        return 'attachment; filename="' . $this->filename() . '"';
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param Request $request the incoming request.
     * @return Response the response.
     */
    public function toResponse($request)
    {
        return parent::toResponse($request)->header('Content-Disposition', $this->contentDisposition());
    }

    /**
     * Convert the report to the multipart representation.
     *
     * @return array the multipart representation.
     */
    public function multipart()
    {
        // TODO: use contentDisposition()
        return [
            [
                'name' => 'attachment',
                'contents' => $this->output(),
                'headers' => [
                    'Content-Type' => $this->mimeType(),
                    'Content-Disposition' => 'form-data; name=attachment; filename=' . $this->filename()
                ]
            ]
        ];
    }
}
