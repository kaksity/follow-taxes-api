<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\BudgetItemsRequest;
use App\Http\Resources\V1\Admin\BudgetItemResource;
use App\Models\BudgetItem;
use PHPUnit\Runner\Exception;

class BudgetItemController  extends Controller
{
    public function __construct(public BudgetItem $budgetItem)
    {
        $this->budgetItem = $budgetItem;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgetitems = $this->budgetItem->latest()->get();
        return BudgetItemResource::collection($budgetitems);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetItemsRequest $request)
    {
       try {
            
            $budgetitems = $this->budgetItem->where([
                'name' => $request->name,
                'type' => $request->type,

            ])->first();
            
            if($budgetitems){
                throw new Exception("Budget Items Already exist", 400);
            }

            $this->budgetItem->create([
                'name' => $request->name,
                'type' => $request->type
            ]);

            $data['message'] = 'Budget Item record was created successfully';

            return successParser($data, 201);

       } catch (Exception $ex) {
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
    public function update(BudgetItemsRequest $request, $id)
    {
        try {

            $budgetitem = $this->budgetItem->find($id);

            if($budgetitem == null){
                throw new Exception("Budget Item does not exist", 404);
            }

            $budgetitem->update([
                'name' => $request->name,
                'type' => $request->type
            ]);

            $data['message'] = 'Budget Item record was updated successfully';

            return successParser($data);

       } catch (Exception $ex) {
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
        try {

            $budgetitem = $this->budgetItem->find($id);

            if($budgetitem == null){
                throw new Exception("Budget Item does not exist", 404);
            }

            $budgetitem->delete();

            $data['message'] = 'Budget Item record was deleted successfully';

            return successParser($data);

       } catch (Exception $ex) {
            $data['message'] = $ex->getMessage();
            $code = $ex->getCode();
            return errorParser($data, $code);
       }
    }
}
