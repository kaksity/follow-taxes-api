<?php

namespace App\Http\Controllers\V1\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct(Project $project)
    {
        $this->project = $project;
    }
    public function index()
    {
        // Total Number Project
        $projects = $this->project->get();

        $lowestContractAmount = DB::table('projects')->select('*')->where('deleted_at',null)->min('contract_amount');//DB::query("SELECT min(contract_amount) as min_contract_amount FROM projects WHERE deleted_at is null");
        $highestContractAmount = DB::table('projects')->select('*')->where('deleted_at',null)->max('contract_amount');
        // $sumContractAmount = DB::query("SELECT sum(contract_amount) as sum_contract_amount FROM projects WHERE deleted_at is null");

        dd($lowestContractAmount, $highestContractAmount);
        return [
            'number_of_projects' => $projects->count(),
            // 'total_contract_amount' => $sumContractAmount->sum_contract_amount,
            // 'highest_contract_amount' => $highestContractAmount->max_contract_amount,
            'lowest_contract_amount' => $lowestContractAmount->contract_amount
        ]; 
    }
}
