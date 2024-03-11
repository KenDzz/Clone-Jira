<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait JsonResponseTrait
{
    protected function result($data, $status, $success)
    {
        return  new JsonResponse(
            [
                'status' => $success,
                'data' => $data ,
                'code' => $status,
            ], $status
        );
    }
}
