<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateVerificationCodeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ActivationController extends Controller
{
    public function activation($code)
    {
        return view('verification.activate', compact('code'));
    }

    public function verification(ValidateVerificationCodeRequest $request)
    {
        if (Hash::check($request->code, $request->real_code)) {
            DB::table('users')
                ->update([
                    'active' => 1
                ]);

            return redirect(route('posts.index'));
        } else {
            return back()->with("error", "Wrong Activation Key");
        }
    }
}
