<?php

namespace App\Http\Controllers\V1\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Public\StateRequest;
use App\Http\Resources\V1\Public\StateResource;
use Illuminate\Http\Request;
use App\Models\State;
use Exception;

class StateController extends Controller
{
    public function __construct(State $state)
    {
        $this->state = $state;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StateRequest $request)
    {
        $states = $this->state->orderBy('state_name', 'ASC')->get();
        return StateResource::collection($states);
    }
}
