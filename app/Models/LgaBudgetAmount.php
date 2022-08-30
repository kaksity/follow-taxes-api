<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LgaBudgetAmount extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;
    protected $guarded = [];
    public function lga()
    {
        return $this->belongsTo(Lga::class, 'lga_id');
    }
}
