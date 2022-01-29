<?php

namespace App\Http\Controllers;

use App\Events\NewVendorAdded;
use App\Http\Requests\VendorFormRequest;
use Exception;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vendor = Vendor::all();
        return ResponseController::response(true, $vendor, Response::HTTP_OK);
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
    public function store(VendorFormRequest $request)
    {
        $validated = $request->validated();
        try {
            $vendor = Vendor::create($validated);
            event(new NewVendorAdded($vendor));
            return ResponseController::response(true, $vendor, Response::HTTP_CREATED);
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
        try {
            $vendor = Vendor::findOrFail($id);
        return ResponseController::response(true, $vendor, Response::HTTP_OK);
        } catch (Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorFormRequest $request, $id)
    {
        $validated = $request->validated();
        try {
            $vendor = Vendor::findOrFail($id);
            $vendor->update($validated);
            return ResponseController::response(true, $vendor, Response::HTTP_OK);
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
        //
        try {
            $vendor = Vendor::findOrFail($id);
            $vendor->delete();
            return ResponseController::response(true, "Vendor has been removed successfully", Response::HTTP_OK);
        } catch (Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
