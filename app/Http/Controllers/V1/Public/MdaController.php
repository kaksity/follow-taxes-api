<?php

namespace App\Http\Controllers\V1\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Public\MdaRequest;
use App\Http\Resources\V1\Public\MdaResource;
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
}
