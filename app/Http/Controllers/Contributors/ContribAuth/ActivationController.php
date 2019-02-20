<?php

namespace App\Http\Controllers\Contributors\ContribAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Contributor;

class ActivationController extends Controller
{
    public function activate(Request $request){
        $user = Contributor::byActivationColumns($request->activation_token)->firstOrFail();
        
        $user->update([
            'active' => true,
            'activation_token' => null
        ]);
        Auth::loginUsingId($user->id);
        return redirect()->route('home')->withSuccess('Activated! You\'re now signed in.');
}
    }
        
