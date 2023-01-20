<?php

namespace App\Http\Controllers\v1\User;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            if(!auth()->user()){
                toastr()->error("Unauthenticated", 'Access denied!');
                return back();
            }
            $plans = Plan::where('is_active', true)->get();
            return view('subscription', compact("plans"));
        } catch (\Throwable $error) {
            toastr()->error($error->getMessage(), 'Error occured');
            return back();
        }
    }

    public function Userindex(Request $request)
    {
        try {
            if(!auth()->user()){
                toastr()->error("Unauthenticated", 'Access denied!');
                return back();
            }
            toastr()->success("Hey, Welcome to your dashboard.", 'Welcome!');
            return view('home');
        } catch (\Throwable $error) {
            toastr()->error($error->getMessage(), 'Error occured');
            return back();
        }
    }
}
