<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contractor extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;

    protected $guarded;

    public function projects()
    {
        return $this->hasMany(Project::class, 'contractor_id');
    }
}
