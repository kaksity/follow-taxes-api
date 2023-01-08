<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\LgaBudgetAmountRequest;
use App\Http\Resources\V1\Admin\LgaBudgetAmountResource;
use App\Models\LgaBudgetAmount;
use Exception;
use Illuminate\Http\Request;

class LgaBudgetAmountController extends Controller
{
    public function __construct(public LgaBudgetAmount $lgaBudgetAmount)
    {
        $this->lgaBudgetAmount = $lgaBudgetAmount;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LgaBudgetAmountRequest $request)
    {
        $lgaId = $request->lga_id ?? null;
        $budgetItemId = $request->budget_item_id ?? null;

        $lgaBudgetAmounts = $this->lgaBudgetAmount->with(['lga', 'budgetItem'])->when($lgaId, function ($model, $lgaId) {
            $model->where('lga_id', $lgaId);
        })->when($budgetItemId, function($model, $budgetItemId) {
            $model->where('lga_id', $budgetItemId);
        })->latest()->get();
        return LgaBudgetAmountResource::collection($lgaBudgetAmounts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LgaBudgetAmountRequest $request)
    {
        try
        {
            $lgaBudgetAmount = $this->lgaBudgetAmount->where([
                'lga_id' => $request->lga_id,
                'budget_item_id' => $request->budget_item_id,
                'year' => $request->year,
            ])->first();

            if($lgaBudgetAmount)
            {
                throw new Exception('LGA Budget Amount record already exist', 400);
            }

            $this->lgaBudgetAmount->create([
                'lga_id' => $request->lga_id,
                'budget_item_id' => $request->budget_item_id,
                'year' => $request->year,
                'proposed_amount' => $request->proposed_amount,
                'approved_amount' => $request->approved_amount,
                'revised_amount' => $request->revised_amount,
                'actual_amount' => $request->actual_amount,
            ]);

            $data['message'] = 'LGA Budget Amount record was created successfully';
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
    public function update(Request $request, $id)
    {
        try
        {
            $lgaBudgetAmount = $this->lgaBudgetAmount->find($id);

            if($lgaBudgetAmount == null)
            {
                throw new Exception('LGA Budget Amount record does exist', 404);
            }

            $lgaBudgetAmount->update([
                'proposed_amount' => $request->proposed_amount,
                'approved_amount' => $request->approved_amount,
                'revised_amount' => $request->revised_amount,
                'actual_amount' => $request->actual_amount,
            ]);

            $data['message'] = 'LGA Budget Amount record was update successfully';
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
            $lgaBudgetAmount = $this->lgaBudgetAmount->find($id);

            if($lgaBudgetAmount == null)
            {
                throw new Exception('LGA Budget Amount record does exist', 404);
            }

            $lgaBudgetAmount->delete();

            $data['message'] = 'LGA Budget Amount record was deleted successfully';
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
