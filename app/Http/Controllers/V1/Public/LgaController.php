<?php

namespace App\Http\Controllers\V1\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Public\LgaRequest;
use App\Http\Resources\V1\Public\LgaResource;
use Exception;
use Illuminate\Http\Request;
use App\Models\Lga;
use App\Models\State;

class LgaController extends Controller
{
    public function __construct(Lga $lga, State $state)
    {
        $this->lga = $lga;
        $this->state = $state;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LgaRequest $request)
    {
        $stateId = $request->state_id ?? null;

        $lgas = $this->lga->with(['state'])->when($stateId, function($model, $stateId) {
            $model->where('state_id', $stateId);
        })->orderBy('lga_name', 'ASC')->get();
        return LgaResource::collection($lgas);
    }
}
