<?php

namespace App\Http\Controllers\API;

use App\Events\NewTaskEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\NextTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Repositories\Interfaces\UserProjectRepositoryInterface;
use App\Repositories\Interfaces\UserTaskRepositoryInterface;
use App\Services\EmailService;
use App\Traits\JsonResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    use JsonResponseTrait;

    private $taskRepository;
    private $userTaskRepository;

    private $emailService;

    private $userProjectRepository;

    private $MAX_LEVEL = 4;

    private $MIN_LEVEL = 1;


    public function __construct(TaskRepositoryInterface $taskRepositoryInterface, UserTaskRepositoryInterface $userTaskRepositoryInterface, UserProjectRepositoryInterface $userProjectRepositoryInterface, EmailService $emailService)
    {
        $this->taskRepository = $taskRepositoryInterface;
        $this->userTaskRepository = $userTaskRepositoryInterface;
        $this->emailService = $emailService;
        $this->userProjectRepository = $userProjectRepositoryInterface;
        $this->middleware('auth:api', ['except' => ['']]);
        $this->middleware('isAdmin:api', ['except' => ['GetTaskInfoById', 'GetTaskInfo']]);
    }


    /**
     * @OA\Get(
     *     path="/task/info/{id}",
     *     tags={"task"},
     *     summary="Get Task Info By ID",
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
     *         description="ID of the Task",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function GetTaskInfoById($id)
    {
        if (!is_numeric($id)) {
            return $this->result(__("task.get.id.numeric"), Response::HTTP_BAD_REQUEST, false);
        }
        $dataTask = $this->taskRepository->find($id);
        $checkUserExistProject = $this->userProjectRepository->checkUserExitsInProject(auth()->user()->id, $dataTask->Project->id);
        if (!$checkUserExistProject && auth()->user()->permission_id != config('app.ROLE_ADMIN')) {
            return $this->result(['message' => __("project.get.auth.exits")], Response::HTTP_UNAUTHORIZED, false);
        }
        return $this->result(new TaskResource($this->taskRepository->find($id)), Response::HTTP_OK, true);
    }

    /**
     * @OA\Get(
     *     path="/task/{id}",
     *     tags={"task"},
     *     summary="Get List Task Info By Project ID",
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
     *         description="ID of the Project",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function GetTaskInfo($id)
    {

        if (!is_numeric($id)) {
            return $this->result(__("task.get.id.numeric"), Response::HTTP_BAD_REQUEST, false);
        }
        $checkUserExistProject = $this->userProjectRepository->checkUserExitsInProject(auth()->user()->id, $id);
        if (!$checkUserExistProject && auth()->user()->permission_id != config('app.ROLE_ADMIN')) {
            return $this->result(['message' => __("project.get.auth.exits")], Response::HTTP_UNAUTHORIZED, false);
        }
        return $this->result(TaskResource::collection($this->taskRepository->GetAllTask($id)), Response::HTTP_OK, true);
    }



    /**
     * @OA\Post(
     *     path="/task/add",
     *     tags={"task"},
     *     summary="Create task",
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
     *                     property="project_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="level_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="category_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="describes",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="priority_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="datetimes",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="user[]",
     *                     type="array",
     *                     collectionFormat="multi",
     *                     @OA\Items(type="string", format="id"),
     *                 ),
     *                 example={"project_id": 1,"level_id" : 1, "category_id": 1, "name": "hi KenDzz", "describes": "hi KenDzz", "priority_id" : 1, "datetimes" : "3/07/2024 04:00 PM - 3/23/2024 12:00 AM", "user[]": 2}
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
    public function CreateTask(CreateTaskRequest $request)
    {
        $filteredDataTask = $request->only([
            'category_id',
            'level_id',
            "name",
            "describes",
            "project_id",
            "priority_id",
        ]);

        $dataFormatDate = explode('-', $request->datetimes);
        $filteredDataTask['start_time'] = Carbon::parse($dataFormatDate[0]);
        $filteredDataTask['estimate_time'] = Carbon::parse($dataFormatDate[1]);
        $resultCreate = $this->taskRepository->create($filteredDataTask);
        $resultCreateUserProject = $this->userTaskRepository->CreateUserTask($resultCreate->id, $request['users']);
        foreach ($resultCreateUserProject as $key => $value) {
            $this->emailService->sendMailNotificationJoinTask($value, __('mail.notification.join.task.desc', ['title' => $resultCreate->name]));
        }

        return $this->result($resultCreate, Response::HTTP_OK, true);
    }


        /**
     * @OA\delete(
     *     path="/task/delete/{id}",
     *     tags={"task"},
     *     summary="Delete task",
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
     *         description="ID of the task to delete",
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
    public function DeleteTaskByID($id)
    {

        if (!is_numeric($id)) {
            return $this->result(['message' => __("task.delete.id.numeric")], Response::HTTP_BAD_REQUEST, false);
        }
        return $this->result($this->taskRepository->delete($id), Response::HTTP_OK, true);
    }


    /**
     * @OA\Post(
     *     path="/task/update",
     *     tags={"task"},
     *     summary="Update task",
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
     *                     property="id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="level_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="category_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="describes",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="priority_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="datetimes",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="user[]",
     *                     type="array",
     *                     collectionFormat="multi",
     *                     @OA\Items(type="string", format="id"),
     *                 ),
     *                 example={"id": 1,"level_id" : 1, "category_id": 1, "name": "hi KenDzz", "describes": "hi KenDzz", "priority_id" : 1, "datetimes" : "3/07/2024 04:00 PM - 3/23/2024 12:00 AM", "user[]": 2}
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
    public function UpdateTask(UpdateTaskRequest $request)
    {
        $filteredDataTask = $request->only([
            'category_id',
            'level_id',
            "name",
            "describes",
            "priority_id",
        ]);
        $dataFormatDate = explode('-', $request->datetimes);
        $filteredDataTask['start_time'] = Carbon::parse($dataFormatDate[0]);
        $filteredDataTask['estimate_time'] = Carbon::parse($dataFormatDate[1]);
        $resultUpdateNewUserTask  = $this->userTaskRepository->UpdateUserTask($request->id, $request['users']);
        $resultTask = $this->taskRepository->update($request['id'], $filteredDataTask);
        foreach ($resultUpdateNewUserTask as $key => $value) {
            event(new NewTaskEvent($resultTask,$value));
            $this->emailService->sendMailNotificationJoinTask($value, __('mail.notification.join.task.desc', ['title' => $resultTask->name]));
        }
        return $this->result(new TaskResource($resultTask), Response::HTTP_OK, true);
    }


    /**
     * @OA\Post(
     *     path="/task/level/update",
     *     tags={"task"},
     *     summary="Update level task",
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
     *                     property="id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="level_id",
     *                     type="integer"
     *                 ),
     *
     *                 @OA\Property(
     *                     property="type",
     *                     type="boolean"
     *                 ),
     *
     *                 example={"id": 1,"level_id" : 1, "type": 0}
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
    public function UpdateLevelTask(NextTaskRequest $request)
    {
        $filteredDataTask = $request->only([
            'level_id',
        ]);

        if ($filteredDataTask['level_id'] >= $this->MAX_LEVEL && $request['type']) {
            return $this->result(['message' => __("task.update.level.max")], Response::HTTP_OK, false);
        } else if ($filteredDataTask['level_id'] <= $this->MIN_LEVEL && !$request['type']) {
            return $this->result(['message' => __("task.update.level.min")], Response::HTTP_OK, false);
        }

        if ($request['type']) {
            $filteredDataTask['level_id'] += 1;
        } else {
            $filteredDataTask['level_id'] -= 1;
        }
        return $this->result(new TaskResource($this->taskRepository->update($request['id'], $filteredDataTask)), Response::HTTP_OK, true);
    }
}
