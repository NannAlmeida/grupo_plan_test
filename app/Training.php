<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'name', 'description', 'start_date', 'end_date'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_trainings')
                    ->withPivot('status', 'progress', 'note');
    }
}
