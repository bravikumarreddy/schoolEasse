<?php

namespace App\Listeners;

use App\Events\StudentInfoUpdateRequested;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\User\UserService;

class UpdateStudentInfo
{
    protected $userService;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the event.
     *
     * @param  StudentInfoUpdateRequested  $event
     * @return void
     */
    public function handle(StudentInfoUpdateRequested $event)
    {
        try{
            $this->userService->updateStudentInfo($event->request,$event->student_id);
            return true;
        } catch(\Exception $ex) {
            ddd($ex);
            return false;
        }
    }
}
