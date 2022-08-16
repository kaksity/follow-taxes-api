<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\MdaRequest;
use App\Http\Resources\V1\Admin\MdaResource;
use Exception;
use Illuminate\Http\Request;
use App\Models\Mda;
class MdaController extends Controller
{
    public function __construct(Mda $mda)
    {
        $this->mda = $mda;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MdaRequest $request)
    {
        $mdas = $this->mda->orderBy('mda_name', 'ASC')->get();
        return MdaResource::collection($mdas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MdaRequest $request)
    {
        try
        {
            $mda = $this->mda->where([
                'mda_name' => $request->mda_name
            ])->first();

            if($mda)
            {
                throw new Exception('MDA record already exist', 400);
            }
            $this->mda->create([
                'mda_name' => $request->mda_name
            ]);
            $data['message'] = 'MDA record was created successfully';
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MdaRequest $request, $id)
    {
        try
        {
            $mda = $this->mda->find($id);

            if(is_null($mda))
            {
                throw new Exception('MDA record does not exist', 404);
            }

            $mda->update([
                'mda_name' => $request->mda_name
            ]);

            $data['message'] = 'MDA record was updated successfully';

            return successParser($data, 200);
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
            $mda = $this->mda->find($id);

            if(is_null($mda))
            {
                throw new Exception('MDA record does not exist', 404);
            }

            $mda->delete();
            $data['message'] = 'MDA record was deleted successfully';
            
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
