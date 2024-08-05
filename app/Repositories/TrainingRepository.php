<?php

namespace App\Repositories;

use App\Enums\UserRoles;
use App\Training;

class TrainingRepository
{
    public $training;

    public function __construct(
        Training $training
    )
    {
        $this->training = $training;
    }

    public function userTrainings() {
        return $this->training->with('users')->get();
    }
}