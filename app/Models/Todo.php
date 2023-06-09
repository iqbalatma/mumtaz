<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["name", "project_id"];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
