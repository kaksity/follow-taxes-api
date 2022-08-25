<?php

namespace App\Http\Controllers\V1\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Public\ProjectRequest;
use App\Http\Resources\V1\Public\ProjectResource;
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
    public function index()
    {
        $projects = $this->project->latest()->get();
        return ProjectResource::collection($projects);
    }
}
