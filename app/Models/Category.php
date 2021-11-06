<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function workouts()
    {
        return $this->belongsToMany(Workout::class, "workout_categories");
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getRoute()
    {
        return route("categories") . "/" . $this->slug;
    }


}
