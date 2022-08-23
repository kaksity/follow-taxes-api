<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends Model
{
    use HasFactory, SoftDeletes, UuidTrait;

    protected $guarded = [];

    public function projects()
    {
        return $this->hasMany(Project::class, 'sector_id');
    }
}
