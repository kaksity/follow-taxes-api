<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\SectorRequest;
use App\Http\Resources\V1\Admin\SectorResource;
use App\Models\Sector;
use Exception;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function __construct(Sector $sector)
    {
        $this->sector = $sector;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = $this->sector->orderBy('sector_name')->get();
        return SectorResource::collection($sectors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectorRequest $request)
    {
        try
        {
            $sector = $this->sector->where('sector_name')->first();

            if($sector)
            {
                throw new Exception('Sector record already exist');
            }

            $this->sector->create([
                'sector_name' => $request->sector_name
            ]);

            $data['message'] = 'Sector record was created successfully';

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
    public function update(SectorRequest $request, $id)
    {
        try
        {
            $sector = $this->sector->find($id);

            if($sector == null)
            {
                throw new Exception('Sector record does not exist');
            }

            $sector->update([
                'sector_name' => $request->sector_name
            ]);

            $data['message'] = 'Sector record was updated successfully';

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
            $sector = $this->sector->find($id);

            if($sector == null)
            {
                throw new Exception('Sector record does not exist');
            }

            $sector->delete();

            $data['message'] = 'Sector record was created successfully';

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
