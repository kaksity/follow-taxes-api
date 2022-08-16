<?php

namespace App\Http\Controllers\V1\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Public\ContractorRequest;
use App\Http\Resources\V1\Public\ContractorResource;
use Exception;
use Illuminate\Http\Request;
use App\Models\Contractor;
class ContractorController extends Controller
{
    public function __construct(Contractor $contractor)
    {
        $this->contractor = $contractor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContractorRequest $request)
    {
        $contractors = $this->contractor->orderBy('contractor_name', 'ASC')->get();
        return ContractorResource::collection($contractors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractorRequest $request)
    {
        try
        {
            $contractor = $this->contractor->where([
                'contractor_name' => $request->contractor_name
            ])->first();

            if($contractor)
            {
                throw new Exception('Contractor record already exists', 400);
            }

            $this->contractor->create([
                'contractor_name' => $request->contractor_name
            ]);

            $data['message'] = 'Contractor record was created successfully';

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
    public function update(ContractorRequest $request, $id)
    {
        try
        {
            $contractor = $this->contractor->find($id);

            if(is_null($contractor))
            {
                throw new Exception('Contractor record does not exist', 404);
            }
            
            $contractor->update([
                'contractor_name' => $request->contractor_name
            ]);

            $data['message'] = 'Contractor record was updated successfully';
            return successParser($data);
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
            $contractor = $this->contractor->find($id);

            if(is_null($contractor))
            {
                throw new Exception('Contractor record does not exist', 404);
            }
            
            $contractor->delete();

            $data['message'] = 'Contractor record was deleted successfully';
            return successParser($data);
        }
        catch(Exception $ex)
        {
            $data['message'] = $ex->getMessage();
            $code = $ex->getCode();
            return errorParser($data, $code);
        }
    }
}
