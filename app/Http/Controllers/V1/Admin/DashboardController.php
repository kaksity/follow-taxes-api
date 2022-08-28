<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contractor;
use App\Models\Mda;
use App\Models\Project;
use App\Models\Sector;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        Project $project,
        Mda $mda,
        Contractor $contractor,
        Sector $sector
    )
    {
        $this->project = $project;
        $this->mda = $mda;
        $this->contractor = $contractor;
        $this->sector = $sector;
    }
    public function index() {
        $data = [];

        $data['total_number_of_projects'] = $this->project->get()->count();
        $data['total_number_of_mdas'] = $this->mda->get()->count();
        $data['total_number_of_sector'] = $this->sector->get()->count();
        $data['total_number_of_contractor'] = $this->contractor->get()->count();

        
        return $data;
    }
}
