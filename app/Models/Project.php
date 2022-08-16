<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;

    protected $guarded;

    public function mda()
    {
        return $this->belongsTo(Mda::class, 'mda_id');
    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class, 'contractor_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function lga()
    {
        return $this->belongsTo(Lga::class, 'lga_id');
    }
}
