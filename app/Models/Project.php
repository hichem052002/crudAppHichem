<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class project extends Model
{
    protected $table='projects';
    protected $primaryKey='id';
    protected $fillable=['name'];
    use HasFactory;
    use SoftDeletes;
    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class);
    }
}
