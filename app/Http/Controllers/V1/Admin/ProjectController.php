<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\ProjectRequest;
use App\Http\Resources\V1\Admin\ProjectResource;
use Exception;
use App\Models\Contractor;
use App\Models\Lga;
use App\Models\Mda;
use App\Models\Project;
use App\Models\State;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(Contractor $contractor, State $state, Lga $lga, Mda $mda, Project $project)
    {
        $this->state = $state;
        $this->lga = $lga;
        $this->mda = $mda;
        $this->contractor = $contractor;
        $this->project = $project;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectRequest $request)
    {
        $perPage = $request->per_page ?? 20;
        $projects = $this->project->latest()->paginate($perPage);
        return ProjectResource::collection($projects);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        try
        {
            // Check if the state exists
            $state = $this->state->find($request->state_id);
            if(is_null($state))
            {
                throw new Exception('State record does not exist', 404);
            }

            // Check if the lga exists
            $lga = $this->lga->find($request->lga_id);
            if(is_null($lga))
            {
                throw new Exception('LGA record does not exist', 404);
            }

            // Check if the contractor exists
            $contractor = $this->contractor->find($request->contractor_id);
            if(is_null($contractor))
            {
                throw new Exception('Contractor record does not exist', 404);
            }
            
            // Check if the mda exists
            $mda = $this->mda->find($request->mda_id);

            if(is_null($mda))
            {
                throw new Exception('MDA record does not exist', 404);
            }

            $this->project->create([
                'title' => $request->title,
                'state_id' => $request->state_id,
                'lga_id' => $request->lga_id,
                'year' => $request->year,
                'contractor_id' => $request->contractor_id,
                'budget_amount' => $request->budget_amount,
                'contract_amount' => $request->contract_amount,
                'mda_id' => $request->mda_id
            ]);

            $data['message'] = 'Project record was created successfully';

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $project = $this->project->find($id);

            if(is_null($project))
            {
                throw new Exception('Project record does not exist', 404);
            }

            return new ProjectResource($project);
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
    public function update(ProjectRequest $request, $id)
    {
        try
        {
            $project = $this->project->find($id);

            if(is_null($project))
            {
                throw new Exception('Project record does not exist', 404);
            }

            // Check if the state exists
            $state = $this->state->find($request->state_id);
            if(is_null($state))
            {
                throw new Exception('State record does not exist', 404);
            }

            // Check if the lga exists
            $lga = $this->lga->find($request->lga_id);
            if(is_null($lga))
            {
                throw new Exception('LGA record does not exist', 404);
            }

            // Check if the contractor exists
            $contractor = $this->contractor->find($request->contractor_id);
            if(is_null($contractor))
            {
                throw new Exception('Contractor record does not exist', 404);
            }
            
            // Check if the mda exists
            $mda = $this->mda->find($request->mda_id);

            if(is_null($mda))
            {
                throw new Exception('MDA record does not exist', 404);
            }

            $this->project->create([
                'title' => $request->title,
                'state_id' => $request->state_id,
                'lga_id' => $request->lga_id,
                'year' => $request->year,
                'contractor_id' => $request->contractor_id,
                'budget_amount' => $request->budget_amount,
                'contract_amount' => $request->contract_amount,
                'mda_id' => $request->mda_id
            ]);
            
            $data['message'] = 'Project record was updated successfully';

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
            $project = $this->project->find($id);

            if(is_null($project))
            {
                throw new Exception('Project record does not exist', 404);
            }
            $project->delete();
            $data['message'] = 'Project record was deleted successfully';

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
