<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Events\NewUserAdded;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return ResponseController::response(true, $user, Response::HTTP_OK);
    }

    /**
     * login user.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            Auth::user()->tokens()->delete();
            $user = Auth::user();
            $token = $user->createToken($user->email)->plainTextToken;
            return ResponseController::response(true, ["user"=>$user, "token"=>$token], Response::HTTP_OK);
        }else{
            return ResponseController::response(false, "Invalid Credential", Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
    //  * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $validated = $request->safe()->except(['is_disabled']);
        $validated["password"] = Hash::make($validated["password"]);
        try {
            $user = User::create($validated);
            event(new NewUserAdded($user));
            return ResponseController::response(true, $user, Response::HTTP_CREATED);
        } catch (Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return ResponseController::response(true, $user, Response::HTTP_OK);
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
    public function update(UserRequest $request, $id)
    {           
        $validated = $request->safe()->except(['password']);
        try {
            $user = User::findOrFail($id);
            $user->update($validated);
            return ResponseController::response(true, $user, Response::HTTP_OK);
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
            $user = User::findOrFail($id);
            $user->delete();
            return ResponseController::response(true, "User has been removed successfully", Response::HTTP_OK);
        } catch (Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
