<?php

namespace App\Http\Controllers;

use App\Events\AssetAssigned;
use Exception;
use Illuminate\Http\Request;
use App\Models\AssetAssignment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AssignmentFormRequest;
use Symfony\Component\HttpFoundation\Response;

class AssetAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $assignment = AssetAssignment::with('user')->paginate(10);
        return ResponseController::response(true, $assignment, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssignmentFormRequest $request)
    {
        $validated = $request->safe()->except(['assigned_by']);
        $validated["assigned_by"] = Auth::user()->id;
        try {
            $assignment = AssetAssignment::create($validated);
            event(new AssetAssigned($assignment));
            return ResponseController::response(true, $assignment, Response::HTTP_CREATED);
        } catch (Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $assignment = AssetAssignment::with('user')->findOrFail($id);
        return ResponseController::response(true, $assignment, Response::HTTP_OK);
        } catch (Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssignmentFormRequest $request, $id)
    {
        //
        $validated = $request->safe()->except(['assigned_by']);
        $validated["assigned_by"] = Auth::user()->id;
        try {
            $assignment = AssetAssignment::findOrFail($id);
            $assignment->update($validated);
            return ResponseController::response(true, $assignment, Response::HTTP_OK);
        } catch (Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
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
            $assignment = AssetAssignment::findOrFail($id);
            $assignment->delete();
            return ResponseController::response(true, "Asset Assignment has been removed successfully", Response::HTTP_OK);
        } catch (Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
