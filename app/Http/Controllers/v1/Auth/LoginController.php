<?php

namespace App\Http\Controllers\v1\Auth;

use Illuminate\Http\Request;
use App\Helpers\SchoolMgtHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Responser\JsonResponser;
use App\Repositories\RegisterRepository;
use App\Helpers\ProcessAuditLog;

class LoginController extends Controller
{
    protected $registerRepository;
    public function __construct(RegisterRepository $registerRepository){
        $this->registerRepository = $registerRepository;
    }

    public function login(Request $request)
    {

        $credentials = request(['email', 'password']);

        // Check if user can login
        $userInstance = $this->registerRepository->findByEmail($request->email);
        if (!$userInstance) {
            toastr()->error('You are not yet registered on this platform.', 'Record not found!');
            return back();
        }

        if ($userInstance->is_verified == false){
            toastr()->error('Please verify your email and try again.', 'Account not verified!');
            return back();

        }



        if (! $token = auth()->attempt($credentials)) {
            toastr()->error('Your email or password is incorrect.', 'Incorrect email or password');
            return back();
        }

        $dataToLog = [
            'causer_id' => $userInstance->id,
            'action_id' => $userInstance->id,
            'action_type' => "Models\User",
            'log_name' => "User logged in successfully",
            'description' => "{$userInstance->firstname} {$userInstance->lastname} logged in successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        $data = [
            "user" => auth()->user(),
        ];

        // Data to return
        return view('home', $data);

    }

    public function logout()
    {
        auth()->logout();
        toastr()->error('User successfully signed out.', 'Logout');
        return view('index');
    }
}



