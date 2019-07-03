<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Permission;
use DB;
//use App\Http\Requests\RoleRequest;

class RoleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $roles = Role::all();
        return view('cpanel.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $permissions = Permission::all();
        return view('cpanel.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required',
            'permission' => 'required',
        ]);
        $role = new Role();
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();
        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }
        return redirect()->route('role.index')
            ->with('success','Role created successfully');
    }

    /**
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
        //
        $role = Role::find($id);
        $permissions = Permission::all();
        $role_permissions = $role->perms()->pluck('id', 'id')->toArray();
        return view('cpanel.role.edit', compact(['role', 'role_permissions', 'permissions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
        $role = Role::find($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        DB::table('permission_role')->where('role_id', $id)->delete();
        foreach ($request->permission as $key => $value) {
            $role->attachPermission($value);
        }
        return redirect()->route('role.index')->withMessage('Role Updated');
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
        DB::table('roles')->where('id', $id)->delete();
        // $role->delete();

        return back()->withMessage('Role Deleted');
    }

    public function assighRole() {
        $user = User::where('name', '=', 'Admin')->first();


        // or eloquent's original technique
      //  $done = $user->roles()->attach($admin->id); // id only
        // return($done);
    }

}
