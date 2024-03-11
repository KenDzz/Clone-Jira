<?php
namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;

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
