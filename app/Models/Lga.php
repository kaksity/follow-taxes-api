<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lga extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;

    protected $guarded;

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'lga_id');
    }

    public function lgaBudgetAmount()
    {
        return $this->hasMany(LgaBudgetAmount::class, 'lga_id');
    }
}
