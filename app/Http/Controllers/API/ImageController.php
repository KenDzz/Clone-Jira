<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUploadRequest;
use App\Traits\JsonImageUploadResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    use JsonImageUploadResponseTrait;

    private $PATH_IMAGE = 'app/task/images/';


    public function __construct() {
        $this->middleware('auth:api', ['except' => ['ShowImage']]);
        $this->middleware('isAdmin:api', ['except' => ['ShowImage']]);

    }

    /**
     * @OA\Post(
     *     path="/images/upload",
     *     tags={"upload"},
     *     summary="Upload Image",
     *     @OA\Parameter(
     *         name="X-localization",
     *         in="header",
     *         description="Set language parameter (Example: 'vi' or 'en'))",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="file to upload",
     *                     property="upload",
     *                     type="file",
     *                     format="file",
     *                 ),
     *                  required={"upload"},
     *             ),
     *
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function StoreImage(ImageUploadRequest $request)
    {
        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = $this->RandomNameFile(pathinfo($originName, PATHINFO_FILENAME), $request->file('upload')->getClientOriginalExtension());
        $request->file('upload')->storeAs('images', $fileName, 'task');
        $url = route('image.show', ['fileName' => $fileName]);
        return $this->result($fileName, 1, $url, Response::HTTP_OK);
    }

    private function RandomNameFile($fileName, $extension)
    {
        $bytes = openssl_random_pseudo_bytes(10);
        $randomString = bin2hex($bytes);
        return $fileName . $randomString . '_' . time() . '.' . $extension;
    }

    public function ShowImage($fileName)
    {
        $filePath = storage_path($this->PATH_IMAGE . $fileName);
        if (!file_exists($filePath)) {
            abort(404);
        }
        $fileContents = file_get_contents($filePath);
        $response = response($fileContents, 200);
        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }
}
