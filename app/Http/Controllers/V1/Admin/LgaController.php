<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\LgaRequest;
use App\Http\Resources\V1\Admin\LgaResource;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LgaRequest $request)
    {
        try
        {
            $state = $this->state->find($request->state_id);

            if(is_null($state))
            {
                throw new Exception('State record does not exist', 404);
            }

            $lga = $this->lga->where([
                'lga_name' => $request->lga_name
            ])->first();            

            if($lga)
            {
                throw new Exception('LGA record already exist', 400);
            }

            $this->lga->create([
                'state_id' => $request->state_id,
                'lga_name' => $request->lga_name
            ]);

            $data['message'] = 'LGA record was created successfully';

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
            $lga = $this->lga->find($id);
            if(is_null($lga))
            {
                throw new Exception('LGA record does not exist', 404);
            }

            $lga->delete();

            $data['message'] = 'LGA record was delete successfully';

            return successParser($data, 200);
        }
        catch(Exception $ex)
        {
            $data['message'] = $ex->getMessage();
            $code = $ex->getCode();
            return errorParser($data, $code);
        }
    }
}
