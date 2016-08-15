<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Edit user's settings.
     *
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request)
    {
        if ($request->isMethod('put')) {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email,' .
                    $request->user()->id,
                'password' => 'required|min:6|confirmed',
            ]);

            $user = $request->user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $request->user()->save();
        }
        
        return view('profile.settings', [
            'user' => $request->user(),
        ]);
    }
}
