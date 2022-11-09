<?php

namespace App\Http\Controllers\V1\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\LgaBudgetAmountRequest;
use App\Http\Resources\V1\Admin\LgaBudgetAmountResource;
use App\Models\LgaBudgetAmount;
use Exception;
use Illuminate\Http\Request;

class LgaBudgetAmountController extends Controller
{
    public function __construct(LgaBudgetAmount $lgaBudgetAmount)
    {
        $this->lgaBudgetAmount = $lgaBudgetAmount;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lgaBudgetAmounts = $this->lgaBudgetAmount->latest()->get();
        return LgaBudgetAmountResource::collection($lgaBudgetAmounts);
    }
}
