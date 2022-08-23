<?php

namespace App\Http\Controllers\V1\Public;

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
}
