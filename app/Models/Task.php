<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'project_id', 'user_id'];
    use HasFactory;
    use SoftDeletes;
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function project():BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
