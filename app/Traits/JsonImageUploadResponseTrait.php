<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait JsonImageUploadResponseTrait
{
    protected function result($fileName, $statusUpload, $url, $status)
    {
        return new JsonResponse(
            [
                'fileName' => $fileName,
                'uploaded' => $statusUpload,
                'url' => $url,
            ], $status
        );
    }
}
