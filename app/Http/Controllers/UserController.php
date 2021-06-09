<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * Business logic for the user
 * @author  JP <jose03@simplexi.com.ph>
 * @version 1.0
 * @since   2021. 06. 04
 */
class UserController extends Controller
{
    /**
     * holds the model object
     * @var object
     */
    private $oModel;

    /**
     * main constructor
     * @param UserRepositoryInterface $oModel  - model repository
     */
    public function __construct(UserRepositoryInterface $oModel)
    {
        $this->oModel = $oModel;
    }

    public function index()
    {
        $oCollection = $this->oModel->all();
        return UserResource::collection($oCollection);
    }

    public function register(RegisterUserRequest $oRequest)
    {
        $oModel = $this->oModel->create($oRequest->all());

        return response()->json([
            'user' => $oModel,
            'token' => $oModel->createToken('pugsDoNotFlyHigh')->plainTextToken
        ], 201);
    }

    public function logout(Request $oRequest)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }

    public function login(UserLoginRequest $oRequest)
    {
        $oModel = $this->oModel->where('username', $oRequest->username)->first();
        if ($oModel === null || Hash::check($oRequest->password, $oModel->password) !== true) {
            throw ValidationException::withMessages([
                'username' => 'The provided credentials are incorrect'
            ]);
        }

        return response()->json([
                'user' => $oModel,
                'token' => $oModel->createToken('pugsDoNotFlyHigh')->plainTextToken
            ], 200);
    }
}
