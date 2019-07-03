<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account_Request;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\RoleUser;
use App\Permission;
use DB;
use Auth;
use Mail;


class Acounts_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        $collection = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name as role_name')
            ->get();
   //     $collection = User::orderBy('id','DESC')->paginate(5);
        return view('cpanel.accounts.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = Role::all();
        return view('cpanel.accounts.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,',
            'row_password' => 'required'
        ]);
        $user = new User;
        $user->name= $request->input('name');
        $user->email= $request->input('email');
        $user->password= bcrypt($request->input('row_password'));;
        $user->save();
        $roles=$request->input('role_name');
        $user_role=new RoleUser();
        foreach ($roles as $role)
        {
            $user_role->role_id=$role;
        }
        $user_role->user_id=$user->id;
        $user_role->save();
        return redirect('admin/account')->with('success','User create successfully');
    }

    /*
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id) {
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
        return view('cpanel.accounts.edit', compact('accounts', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
//      $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required|email|unique:users,email,'.$id,
//            'password' => 'same:confirm-password'
//      ]);
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }
        $user = User::find($id);
       // dd($user);
       //    $input['password'] = bcrypt($input['password']);
        $user->update($input);
        DB::table('role_user')->where('user_id',$id)->delete();
        $roles=$request->input('roles');
        $user_role=new RoleUser();
        $user_role->user_id=$user->id;
        $user_role->role_id=$roles;
        $user_role->save();
        return redirect('admin/account')
            ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        User::find($id)->delete();
        return redirect('admin/account')->with('success','User deleted successfully');
    }
}
