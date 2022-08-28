<?php

namespace App\Http\Controllers\V1\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Public\ChartRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function __construct(Project $project)
    {
        $this->project = $project;
    }
    public function index()
    {
        $data = [];
            $projectData['year'] = DB::table('projects')
                    ->select('year', DB::raw('count(*) as count'))
                    ->groupBy('year')
                    ->pluck('count','year');

            $projectData['mda'] = DB::table('projects')
                        ->select('mda_id', DB::raw('count(*) as count'))
                        ->groupBy('mda_id')
                        ->pluck('count','mda_id');

            $projectData['sector'] = DB::table('projects')
                        ->select('sector_id', DB::raw('count(*) as count'))
                        ->groupBy('sector_id')
                        ->pluck('count','sector_id');
            $projectData['contractor'] = DB::table('projects')
                            ->select('contractor_id', DB::raw('count(*) as count'))
                            ->groupBy('contractor_id')
                            ->pluck('count','contractor_id');
            $projectData['lga'] = DB::table('projects')
                                    ->select('lga_id', DB::raw('count(*) as count'))
                                    ->groupBy('lga_id')
                                    ->pluck('count','lga_id');    
            $contractAmountData['year'] = DB::table('projects')
                                        ->select('year', DB::raw('sum(contract_amount) as contract_amount'))
                                        ->groupBy('year')
                                        ->pluck('contract_amount','year');
            $contractAmountData['sector'] = DB::table('projects')
                                            ->select('sector_id', DB::raw('sum(contract_amount) as contract_amount'))
                                            ->groupBy('sector_id')
                                            ->pluck('contract_amount','sector_id');
            $contractAmountData['mda'] = DB::table('projects')
                                            ->select('mda_id', DB::raw('sum(contract_amount) as contract_amount'))
                                            ->groupBy('mda_id')
                                            ->pluck('contract_amount','mda_id');
            $contractAmountData['contractor'] = DB::table('projects')
                                                    ->select('contractor_id', DB::raw('sum(contract_amount) as contract_amount'))
                                                    ->groupBy('contractor_id')
                                                    ->pluck('contract_amount','contractor_id');
            $contractAmountData['lga'] = DB::table('projects')
                                            ->select('lga_id', DB::raw('sum(contract_amount) as contract_amount'))
                                            ->groupBy('lga_id')
                                            ->pluck('contract_amount','lga_id');
        $data['project'] = $projectData;
        $data['contract_amount'] = $contractAmountData;
        return $data;
    }
}
