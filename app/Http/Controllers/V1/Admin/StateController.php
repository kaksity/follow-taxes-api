<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\StateRequest;
use App\Http\Resources\V1\Admin\StateResource;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {
        try
        {
            $state = $this->state->where([
                'state_name' => $request->state_name
            ])->first();

            if($state)
            {
                throw new Exception('State record already exist', 400);
            }


            $this->state->create([
                'state_name' => $request->state_name
            ]);

            $data['message'] = 'State record was created successfully';

            return successParser($data, 201);
        }
        catch(Exception $ex)
        {
            $data['message'] = $ex->getMessage();
            $code = $ex->getCode();
            return errorParser($data, $code);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $state = $this->state->find($id);

            if(is_null($state))
            {
                throw new Exception('State record does not exist', 404);
            }
            $state->delete();
            $data['message'] = 'State record was deleted successfully';

            return successParser($data, 201);
        }
        catch(Exception $ex)
        {
            $data['message'] = $ex->getMessage();
            $code = $ex->getCode();
            return errorParser($data, $code);
        }
    }
}
