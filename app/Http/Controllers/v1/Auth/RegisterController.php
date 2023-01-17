<?php

namespace App\Http\Controllers\v1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\CreateUserRequest;
use App\Repositories\RegisterRepository;
use App\Interfaces\RoleInterface;
use App\Helpers\ProcessAuditLog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

class RegisterController extends Controller
{

    protected $registerRepository;
    public function __construct(RegisterRepository $registerRepository){
        $this->registerRepository = $registerRepository;
    }


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Store user
     */
    public function register(CreateUserRequest $request)
    {

        try {
            DB::beginTransaction();
            $user = $this->registerRepository->create([
                "lastname" => $request->lastname,
                "firstname" => $request->firstname,
                "email" => $request->email,
                "phoneno" => $request->phoneno,
                "companyName" => $request->companyName,
                "password" => Hash::make($request->password),
            ]);
            if(!$user){
                return 1234;
                toaster()->add('Add message here')->error();

            }

            if (isset($request->userRole)) {
                $userRole = $request->userRole;
                $user->attachRole($userRole);
            } else {
                $userRole = RoleInterface::USER;
                $user->attachRole($userRole);
            }

            $newUserToken = bin2hex(openssl_random_pseudo_bytes(30));
            $otpCode = random_int(10000, 99999); //generate random num
            DB::table('user_verifications')->insert(['user_id' => $user->id, 'otp' => $otpCode, 'token'=>$newUserToken, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            $data = [
                'email' => $request->email,
                'name' => $request->lastname.' '.$request->firstname,
                'otp' => $otpCode,
                'user' => $user,
                'subject' => "Account Created Successfully",
                'verification_code' => $newUserToken
            ];
            $dataToLog = [
                'causer_id' => $user->id,
                'action_id' => $user->id,
                'action_type' => "Models\User",
                'log_name' => "Account created successfully",
                'description' => "{$user->firstname} {$user->lastname} account created successfully",
            ];

            ProcessAuditLog::storeAuditLog($dataToLog);

            //send email to verify account

            DB::commit();

            $error = false;
            $message = "Account created successfully. Kindly check your email for verification link";
            $data = $user;
            return JsonResponser::send($error, $message, $data);
        } catch (\Throwable $th) {
            DB::rollback();
            $error = true;
            $message = $th->getMessage();
            $data = [];
            return JsonResponser::send($error, $message, $data);
        }
    }


    /**
     * Validate resend code request
     */
    protected function validateResendCode($request)
    {
        $rules =  [
            'email' => 'required|email|max:255',
        ];

        $validatedData = Validator::make($request->all(), $rules);
        return $validatedData;
    }
}
