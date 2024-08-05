<?php

namespace App\Http\Controllers;

use App\Services\TrainingService;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public $trainingService;

    public function __construct(TrainingService $trainingService)
    {
        $this->trainingService = $trainingService;
    }

    public function index(Request $request)
    {
        return $this->trainingService->allTrainings();
    }
}
