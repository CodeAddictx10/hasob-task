<?php

namespace App\Http\Controllers;

use App\Events\NewAssetAdded;
use Exception;
use App\Models\Asset;
use Illuminate\Http\Request;
use App\Http\Requests\AssetFormRequest;
use Symfony\Component\HttpFoundation\Response;

class AssetController extends Controller
{
    /**
     * Display a listing of asset.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset::paginate(10);
        return ResponseController::response(true, $assets, Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetFormRequest $request)
    {
        $validated = $request->validated();
        try {
            $asset = Asset::create($validated);
            event(new NewAssetAdded($asset));
            return ResponseController::response(true, $asset, Response::HTTP_CREATED);
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
            $asset = Asset::findOrFail($id);
            return ResponseController::response(true, $asset, Response::HTTP_OK);
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
    public function update(AssetFormRequest $request, $id)
    {  
        try {
            $asset = Asset::findOrFail($id);
            $asset->update($request->validated());
            return ResponseController::response(true, $asset, Response::HTTP_OK);
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
            $asset = Asset::findOrFail($id);
            $asset->delete();
            return ResponseController::response(true, "Asset has been removed successfully", Response::HTTP_OK);
        } catch (Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
