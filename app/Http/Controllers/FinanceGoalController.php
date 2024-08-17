<?php

namespace App\Http\Controllers;

use App\Models\FinanceGoal;
use App\Models\Goal;
use App\Http\Requests\StoreFinanceGoalRequest;
use App\Http\Requests\UpdateFinanceGoalRequest;
use Illuminate\Support\Facades\Log;


class FinanceGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $financeGoal = FinanceGoal::all();
        return response()->json(["finance goal" => $financeGoal],);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFinanceGoalRequest $request)
    {
       
        $goal = Goal::create([
            'type' => "finance",
            'user_id' => auth()->id(), 
        ]); 

        $validatedData = $request->validated();
        $validatedData['goal_id'] = $goal->id;
        $financegoal = FinanceGoal::create($validatedData);
    
        return response()->json(["finance goal" => $financegoal], 201);
    }
    


    /**
     * Display the specified resource.
     */
    public function show(FinanceGoal $finance)
    {

        return response()->json(["finance goal" => $finance],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFinanceGoalRequest $request, FinanceGoal $finance)
    {
        $finance -> update($request->validated());
        return response ()->json(["finance goal" => $finance], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinanceGoal $finance)
    {
        $goal = Goal::where('id', $finance->goal_id)->first();
        $finance->delete();
        if ($goal) {
            $goal->delete();
        }
        return response()->json(["message" => "FinanceGoal and corresponding Goal deleted successfully"], 200);
    }
    
}
