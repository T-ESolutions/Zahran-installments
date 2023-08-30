<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Http\Resources\Api\V1\CustomerResource;
use App\Models\Customer;
use App\Traits\BaseApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use BaseApiResponseTrait;


    public function login(LoginRequest $request)
    {

        if (Auth::guard('customer')->attempt($request->only('phone', 'password'))) {
            $user = auth('customer')->user();

            return $this->respondWithSuccess(__('web.messages.login_successfully'), [
                'token' => $user->createToken('api')->plainTextToken,
                'user' => new CustomerResource($user)
            ]);
        }

        return $this->respondWithError(trans('auth.failed'));
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $customer = Customer::create($data);

        return $this->respondWithSuccess(__('web.messages.register_successfully'), [
            'token' => $customer->createToken('api')->plainTextToken,
            'user' => new CustomerResource($customer->fresh())
        ]);
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $user = $this->userRepository->findBy('email', $request->email);

        if (!$user->is_active) {
            return $this->respondWithError(trans('website.validation.access_denied'));
        }

        $passwordReset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('created_at', '>', Carbon::now()->subMinutes(2))
            ->first();

        if ($passwordReset) {
//            return $this->respondWithError(trans('You have to wait 2 minutes to send another code'));
        }


        $code = rand(1111, 9999);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $code,
            'created_at' => Carbon::now()
        ]);

        Mail::to($request->email)->send(new ResetPasswordByCode($code));

        return $this->respondWithSuccess(trans('passwords.sent'), [
            'for_test_only' => $code
        ]);
    }

    public function verifyCode(VerifyCodeRequest $request)
    {
        $data = $request->validated();

        $passwordReset = DB::table('password_resets')
            ->where('token', $data['code'])
//            ->where('created_at', '>', Carbon::now()->subMinutes(2))
            ->first();
        if (!$passwordReset) {
            return $this->respondWithError(trans('passwords.token'));
        }

        return $this->respondWithSuccess(trans('website.auth.code_verified'), [
            'code' => $data['code'],
        ]);
    }

    public function newPassword(NewPasswordRequest $request)
    {
        $data = $request->validated();

        $passwordReset = DB::table('password_resets')
            ->where('token', $data['code'])
//            ->where('created_at', '>', Carbon::now()->subMinutes(2))
            ->first();

        if (!$passwordReset) {
            return $this->respondWithError(trans('passwords.token'));
        }

        $user = User::where('email', $passwordReset->email)->first();
        if (!$user) {
            return $this->respondWithError(trans('passwords.user'));
        }

        $user->password = bcrypt($data['password']);
        $user->save();

        DB::table('password_resets')->where('token', $data['code'])->delete();

        return $this->respondWithSuccess(trans('passwords.reset'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth('api')->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return $this->respondWithError(__('passwords.wrong_current'));
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return $this->respondWithSuccess(trans('passwords.changed'));
    }

    /*
     * Profile data
     */
    public function profile(Request $request)
    {
        $user = $request->user();
        return $this->respondWithSuccess(trans('messages.responses.success'), [
            'user' => new UserResource($user)
        ]);
    }

    public function logout(Request $request)
    {
         auth()->user()->tokens()->delete();
        return $this->respondWithSuccess(trans('auth.logout'));
    }
}
