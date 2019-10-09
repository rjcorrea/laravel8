<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['name', 'description', 'status'];

    public function user()
    {
        return $this->belongsTo(App\User::class);
    }
}
