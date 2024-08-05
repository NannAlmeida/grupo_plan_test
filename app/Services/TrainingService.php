<?php

namespace App\Services;

use App\Repositories\TrainingRepository;

class TrainingService
{
    public $trainingRepository;

    public function __construct(TrainingRepository $trainingRepository)
    {
        $this->trainingRepository = $trainingRepository;
    }

    public function allTrainings()
    {
        return $this->trainingRepository->userTrainings();
    }
}