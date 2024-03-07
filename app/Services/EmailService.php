<?php

namespace App\Services;
use App\Jobs\SendMailJob;
use App\Jobs\SendMailTask;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Traits\JsonErrorResponseTrait;
use Illuminate\Http\Response;

class EmailService
{
    use JsonErrorResponseTrait;


    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepositoryInterface) {
        $this->userRepository = $userRepositoryInterface;
    }


    public function sendMailNotificationJoinProject($userId, $desc) {
        $userDetail = $this->userRepository->find($userId);
        if (!filter_var(trim($userDetail->email), FILTER_VALIDATE_EMAIL)) {
            return $this->result(__('mail.invalid'),Response::HTTP_UNPROCESSABLE_ENTITY, false);
        }
        $dataMail = new \stdClass();
        $dataMail->name = $userDetail->name;
        $dataMail->email = trim($userDetail->email);
        $dataMail->desc = $desc;
        //send mail queue
        SendMailJob::dispatch($dataMail);
    }

    public function sendMailNotificationJoinTask($userId, $desc) {
        $userDetail = $this->userRepository->find($userId);
        if (!filter_var(trim($userDetail->email), FILTER_VALIDATE_EMAIL)) {
            return $this->result(__('mail.invalid'),Response::HTTP_UNPROCESSABLE_ENTITY, false);
        }
        $dataMail = new \stdClass();
        $dataMail->name = $userDetail->name;
        $dataMail->email = trim($userDetail->email);
        $dataMail->desc = $desc;
        //send mail queue
        SendMailTask::dispatch($dataMail);
    }
}
