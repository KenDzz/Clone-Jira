<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Info(
 *     title="API CloneJira",
 *     version="0.1",
 *     @OA\Contact(
 *         email="vvqua.2x@gmail.com"
 *     ),
 * )
 * @OA\Server(
 *     description="CloneJira",
 *     url="http://localhost:8000/api"
 * )
 *
 */


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
