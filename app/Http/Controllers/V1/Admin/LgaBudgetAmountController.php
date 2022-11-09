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
                'year' => $request->year,
                'sector_id' => $request->sector_id
            ])->first();

            if($lgaBudgetAmount)
            {
                throw new Exception('LGA Budget Amount record already exist', 400);
            }

            $this->lgaBudgetAmount->create([
                'lga_id' => $request->lga_id,
                'year' => $request->year,
                'sector_id' => $request->sector_id,
                'amount' => $request->amount
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
                'lga_id' => $request->lga_id,
                'year' => $request->year,
                'amount' => $request->amount
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
