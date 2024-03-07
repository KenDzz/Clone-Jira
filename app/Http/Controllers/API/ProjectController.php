<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\DeleteProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Repositories\Interfaces\UserProjectRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\EmailService;
use App\Traits\JsonErrorResponseTrait;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    use JsonResponseTrait;

    private $projectRepository;

    private $userProjectRepository;

    private $emailService;

    private $userRepository;

    public function __construct(ProjectRepositoryInterface $projectRepositoryInterface, UserProjectRepositoryInterface $userProjectRepositoryInterface, UserRepositoryInterface $userRepositoryInterface, EmailService $emailService)
    {
        $this->projectRepository = $projectRepositoryInterface;
        $this->userProjectRepository = $userProjectRepositoryInterface;
        $this->emailService = $emailService;
        $this->userRepository = $userRepositoryInterface;
        $this->middleware('auth:api', ['except' => []]);
        $this->middleware('isAdmin:api', ['except' => ['GetProjectInfo', 'GetProjectInfoByID']]);
    }

    /**
     * @OA\Get(
     *     path="/project",
     *     tags={"project"},
     *     summary="Get Project Info",
     *     @OA\Parameter(
     *         name="X-localization",
     *         in="header",
     *         description="Set language parameter (Example: 'vi' or 'en'))",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function GetProjectInfo()
    {
        return $this->result(ProjectResource::collection($this->projectRepository->getAll()), Response::HTTP_OK, true);
    }

    /**
     * @OA\Post(
     *     path="/project/add",
     *     tags={"project"},
     *     summary="Add Project",
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
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="describes",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="user[]",
     *                     type="array",
     *                     collectionFormat="multi",
     *                     @OA\Items(type="string", format="id"),
     *                 ),
     *                 example={"name": "hi KenDzz","describes" : "hello", "user[]": "2"}
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
    public function CreateProject(CreateProjectRequest $request)
    {
        $filteredDataProject = $request->only([
            'name',
            'describes'
        ]);
        $resultCreateProject = $this->projectRepository->CreateProject($filteredDataProject);
        $resultCreateUserProject = $this->userProjectRepository->CreateUserProject($resultCreateProject->id, $request['users']);
        foreach ($resultCreateUserProject as $key => $value) {
            $this->emailService->sendMailNotificationJoinProject($value, __('mail.notification.join.desc', ['title' => $resultCreateProject->name]));
        }
        return $this->result($resultCreateProject, Response::HTTP_OK, true);
    }

    /**
     * @OA\delete(
     *     path="/project/delete/{id}",
     *     tags={"project"},
     *     summary="Delete Project",
     *     @OA\Parameter(
     *         name="X-localization",
     *         in="header",
     *         description="Set language parameter (Example: 'vi' or 'en'))",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the project to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function DeleteProjectByID($id)
    {

        if (!is_numeric($id)) {
            return $this->result(['message' => __("project.delete.id.numeric")], Response::HTTP_BAD_REQUEST, false);
        }
        return $this->result($this->projectRepository->delete($id), Response::HTTP_OK, true);
    }

    /**
     * @OA\get(
     *     path="/project/view/{id}",
     *     tags={"project"},
     *     summary="View Project By ID",
     *     @OA\Parameter(
     *         name="X-localization",
     *         in="header",
     *         description="Set language parameter (Example: 'vi' or 'en'))",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the project to view",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function GetProjectInfoByID($id)
    {
        if (!is_numeric($id)) {
            return $this->result(['message' => __("project.delete.id.numeric")], Response::HTTP_BAD_REQUEST, false);
        }
        $checkUserExistProject = $this->userProjectRepository->checkUserExitsInProject(auth()->user()->id, $id);
        if (!$checkUserExistProject && auth()->user()->permission_id != config('app.ROLE_ADMIN')) {
            return $this->result(['message' => __("project.get.auth.exits")], Response::HTTP_UNAUTHORIZED, false);
        }
        return $this->result(new ProjectResource($this->projectRepository->find($id)), Response::HTTP_OK, true);
    }


    /**
     * @OA\Post(
     *     path="/project/update",
     *     tags={"project"},
     *     summary="Update Project",
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
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="describes",
     *                     type="string"
     *                 ),
     *
     *                 @OA\Property(
     *                     property="is_exist",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="user[]",
     *                     type="array",
     *                     collectionFormat="multi",
     *                     @OA\Items(type="string", format="id"),
     *                 ),
     *                 example={"name": "hi KenDzz","describes" : "hello", "is_exist": 0, "user[]": "2"}
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
    public function UpdateProject(UpdateProjectRequest $request)
    {
        $filteredData = $request->only(['name', 'describes', 'is_exist']);
        $resultUpdateNewUserProject  = $this->userProjectRepository->UpdateUserProject($request->id, $request['users']);
        $projectDetail = $this->projectRepository->find($request->id);
        foreach ($resultUpdateNewUserProject as $key => $value) {
            $this->emailService->sendMailNotificationJoinProject($value, __('mail.notification.join.desc', ['title' => $projectDetail->name]));
        }
        return $this->result($this->projectRepository->update($request->id, $filteredData), Response::HTTP_OK, true);
    }
}
