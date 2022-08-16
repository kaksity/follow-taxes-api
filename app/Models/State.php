<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;

    protected $guarded;

    public function lgas()
    {
        return $this->hasMany(LGA::class, 'state_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'state_id');
    }
}
