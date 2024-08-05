<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTraining extends Model
{
    protected $table = 'user_trainings';

    protected $fillable = [
        'user_id', 
        'training_id', 
        'status', 
        'progress', 
        'end_date', 
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
