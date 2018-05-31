<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{

    protected $fillable = ["name", "status", "user_id"];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
