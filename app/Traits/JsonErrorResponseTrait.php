<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait JsonErrorResponseTrait
{
    protected function result($data, $status, $success)
    {
        return new JsonResponse(
            [
                'status' => $success,
                'message' => $data,
                'code' => $status,
            ], $status
        );
    }
}
