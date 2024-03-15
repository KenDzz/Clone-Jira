<?php

namespace App\Http\Controllers\API;

use App\Enums\ProjectStatus;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\DeleteProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Repositories\Interfaces\UserProjectRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\EmailService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use JsonResponseTrait;

    private $projectRepository;

    private $userProjectRepository;

    private $emailService;

    private $userRepository;

    private $checkAdmin;

    public function __construct(ProjectRepositoryInterface $projectRepositoryInterface, UserProjectRepositoryInterface $userProjectRepositoryInterface, UserRepositoryInterface $userRepositoryInterface, EmailService $emailService)
    {
        $this->projectRepository = $projectRepositoryInterface;
        $this->userProjectRepository = $userProjectRepositoryInterface;
        $this->emailService = $emailService;
        $this->userRepository = $userRepositoryInterface;
        $this->middleware('auth:api', ['except' => []]);
        $this->middleware('isAdmin:api', ['except' => ['index', 'show']]);
        $this->checkAdmin = UserType::Administrator();
    }

    /**
     * @OA\Get(
     *     path="/v1/projects",
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
    public function index()
    {
        if($this->checkAdmin->is((int)auth()->user()->permission)){
            return $this->result(ProjectResource::collection($this->projectRepository->getAll()), true);
        }else{
            $listProject = $this->userProjectRepository->GetListProjectByUser(auth()->user()->id);
            return $this->result($this->projectRepository->GetALLMultiProject($listProject), true);
        }
    }

    /**
     * @OA\Post(
     *     path="/v1/projects",
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
    public function store(CreateProjectRequest $request)
    {
        $filteredDataProject = $request->only([
            'name',
            'describes',
            'status'
        ]);


        $resultCreateProject = $this->projectRepository->CreateProject($filteredDataProject);
        $resultCreateUserProject = $this->userProjectRepository->CreateUserProject($resultCreateProject->id, $request['users']);
        foreach ($resultCreateUserProject as $key => $value) {
            $this->emailService->sendMailNotificationJoinProject($value, __('mail.notification.join.desc', ['title' => $resultCreateProject->name]));
        }
        return $this->result($resultCreateProject, true);
    }

    /**
     * @OA\delete(
     *     path="/api/v1/projects/{id}",
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
    public function destroy(int $id)
    {

        if (!is_numeric($id)) {
            return $this->respondNotTheRightParameters( __("project.delete.id.numeric"));
        }
        if(!$this->userProjectRepository->DeleteListByProjectId($id) || !$this->projectRepository->delete($id)){
            return $this->respondInvalidQuery(__("project.delete.id.fail"));
        }
        return $this->respondObjectDeleted($id);
    }

    /**
     * @OA\get(
     *     path="/v1/projects/{id}",
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
    public function show(Request $request,$id)
    {
        if (!is_numeric($id)) {
            return $this->respondNotTheRightParameters(__("project.delete.id.numeric"));
        }
        $checkUserExistProject = $this->userProjectRepository->checkUserExitsInProject(auth()->user()->id, $id);
        if (!$checkUserExistProject && !$this->checkAdmin->is((int)auth()->user()->permission)) {
            return $this->respondUnauthorized(__("project.get.auth.exits"));
        }
        return $this->result(new ProjectResource($this->projectRepository->find($id)), true);
    }


    /**
     * @OA\Patch(
     *     path="/v1/projects/{id}",
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
     *                     property="stutus",
     *                     type="string"
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
    public function update(UpdateProjectRequest $request, int $id)
    {
        if (!is_numeric($id)) {
            return $this->respondNotTheRightParameters(__("project.update.id.numeric"));
        }
        $filteredData = $request->only(['name', 'describes', 'status']);
        $resultUpdate = $this->projectRepository->update($id, $filteredData);
        if(!$resultUpdate){
            return $this->respondInvalidQuery(__("project.update.fail"));
        }
        $resultUpdateNewUserProject  = $this->userProjectRepository->UpdateUserProject($id, $request['users']);
        $projectDetail = $this->projectRepository->find($id);
        foreach ($resultUpdateNewUserProject as $key => $value) {
            $this->emailService->sendMailNotificationJoinProject($value, __('mail.notification.join.desc', ['title' => $projectDetail->name]));
        }
        return $this->result($resultUpdate, true);
    }
}
