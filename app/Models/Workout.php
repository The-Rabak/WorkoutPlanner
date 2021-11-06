<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class, "workout_categories");
    }

    public function creator()
    {
        return $this->belongsTo(User::class, "created_by_user_id");
    }
}
