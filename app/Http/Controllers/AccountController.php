<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Mailer;
use App\Role;
use App\User;
use App\RoleUser;
use App\Permission;
use DB;
use Auth;
use Mail;

class AccountController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $counter = 0;
        $usersArray = [];
        $users = User::orderBy('id', 'desc')->get();
        dd($users);
        foreach ($users as $user) {
            $user->load('roles');
            $usersArray[$counter]['id'] = $user->id;
            $usersArray[$counter]['name'] = $user->name;
            $usersArray[$counter]['email'] = $user->email;
            $roles = $user->roles->toArray();

            if (count($roles) > 0) {
                $myroles = [];
                foreach ($roles as $role)
                    $myroles[] = $role['name'];
                $myroles = implode($myroles, ',');
            } else {
                $myroles = '';
            }
            $usersArray[$counter]['roles'] = $myroles;
            //$user[$counter]['roles'] = $user['roles'];
            $counter++;
        }

        $collection = $usersArray;
        //  dd($collection);
        return view('admin.accounts.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = Role::all();
        return view('admin.accounts.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->row_password);
        $user->remember_token = bcrypt($request->remember_token);
        $user->save();

        $message = "Your Password is $request->row_password";
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        //    dd($email);
        //$email = $request->input('email');



        $data = array('name' => $name, 'password' => $request->row_password, 'email' => $request->email, 'loginurl' => url('login'),
            'from' => 'memad@panarab-media.com',
            'from_name' => 'Schools');
        \Mail::send('email.mymail', $data, function ($message) use ($user) {
            $message->to($user->email, 'Schools')
                    ->subject('Welcome To Schools')
                    ->from('memad@panarab-media.com', 'Schools');
        });
        $roles=$request->role_name ;
        dd($roles);
       /* foreach ($roles as $role) {
            $roleId = Role::where('id', $role)->first();
            DB::table('role_user')->insert(
                    ['user_id' => $user->id,
                        'role_id' => $roleId->id]
            );
        }
        return redirect()->route('account.index')->withMessage('You Have Successfully Created a Account');
    */}

    /*     * user_id
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $roles = Role::all();
        $accounts = User::find($id);
        return view('admin.account.edit', compact('accounts', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = bcrypt($request->remember_token);
        $user->save();
        DB::table('role_user')->where('user_id', $user->id)->delete();
        $roles=$request->role_name ;
        dd($roles);
       }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        //$role = Role::find($id);
        DB::table('users')->where('id', $id)->delete();
        DB::table('role_user')->where('user_id', $id)->delete();
        // $role->delete();

        return back()->withMessage('Account Deleted');
    }

}
