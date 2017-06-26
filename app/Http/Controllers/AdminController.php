<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Admin::select('id','name','role')->orderBy('id','ASC')->paginate(5);

        return view('admin.dashboard', compact('data'));
    }

    public function getAdd() 
    {
        return view('admin.add');
    }

    public function postAdd(Request $request)
    {
//        dd($request->get('name'));
        $this->validate($request,[

                'name' => 'required|min:1|max:35',

                'email' => 'required|email',

                'password' => 'required|min:3|confirmed',

                'password_confirmation' => 'required'

            ],[

                'name.required' => ' The name field is required.',

                'name.min' => ' The first name must be at least 5 characters.',

                'name.max' => ' The first name may not be greater than 35 characters.',

                'email.required' => ' The email field is required.',

                'email.email' => 'The email must be a valid email address',

                'password.required' => 'The password field is required',

                'password.min' => ' The first password must be at least 3 characters.',

                'password_confirmation.confirmed' => 'The password not match'

        ]);

        $data = Admin::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'role' => request('rdoLevel')
        ]);
        return redirect(route('admin.dashboard'));
    }

    public function getEdit($id) 
    {
        $data = Admin::find($id);

        if (Auth::guard('admin')->check())
        {
            $current_id = Auth::guard('admin')->user()->id;
            if ($current_id != 1 && ($id == 1 || ($data["role"] == 1 && ($current_id != $id))))
            {
                session()->flash('message', 'Sorry | You Can\'t Access Edit User');
                Session::flash('message', 'You Can\'t Access Edit User');
                return redirect()->route('admin.dashboard');
            }
        }
        return view('admin.edit', compact('data', 'id'));
    }

    public function postEdit($id, Request $request) 
    {
        $data = Admin::find($id);
        $this->validate($request,[

                'name' => 'required|min:1|max:35'

            ],[

                'name.required' => ' The name field is required.',

                'name.min' => ' The first name must be at least 5 characters.',

                'name.max' => ' The first name may not be greater than 35 characters.'

        ]);

        $data->name = request('name');
        $data->role = request('rdoLevel');

        if (request('changepass') == "on")
        {
            $this->validate($request,[

                'password' => 'required|min:3|confirmed',

                'password_confirmation' => 'required'

            ],[
                'password.required' => 'The password field is required',

                'password.min' => ' The first password must be at least 3 characters.',

                'password_confirmation.confirmed' => 'The password not match'

            ]);

            $data->password = bcrypt(request('password'));
        }

        $data->save();

        session()->flash('success', 'Successfully updated!');

        return redirect()->route('admin.dashboard');
    }

    public function getDelete ($id){

        $data = Admin::find($id);

        if (Auth::guard('admin')->check())
        {
            $current_id = Auth::guard('admin')->user()->id;
            if (($id == 1) || ($current_id != 1 && $data["role"] == 1))
            {
                session()->flash('message', 'Sorry | You Can\'t Access Delete User');
                Session::flash('message', 'You Can\'t Access Edit User');
                return redirect()->route('admin.dashboard');
            }
        }

        $data->delete($id);
        session()->flash('success', 'Complete Delete User');
        return redirect()->route('admin.dashboard');
        
    }
    public function search(Request $request)
    {
        if($request->ajax()){
            $search = request('search');
            $data = Admin::where('name', 'LIKE', '%'.$search.'%')->paginate(5);
            return view('admin.dashboard-table', compact('data'));
        }
        
    }
}
