<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\SimpleUserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse|SimpleUserResource
     */
    public function __invoke(LoginRequest $request): JsonResponse|SimpleUserResource
    {
        if (!$this->attemptLogin($request)) {
            return response()->json([
                'success' => false,
                'message' => 'Неверные учетные данные.',
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('laraapi')->plainTextToken;

        return SimpleUserResource::make($user)
            ->additional([
                'success' => true,
                'token' => $token,
            ]);
    }

    /**
     * @param Request $request
     * @return bool
     */
    private function attemptLogin(Request $request): bool
    {
        return Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    }
}
