<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use DB;

class PermissionController extends Controller {

    public function index() {
        $permissions = Permission::all();
        return view('cpanel.permission.index', compact('permissions'));
    }

    public function create() {
        return view('cpanel.permission.create');
    }

    public function store(Request $request) {

        $newPermission = new Permission;
        $newPermission->name = $request->name;
        $newPermission->description = $request->description;
        $newPermission->display_name = $request->display_name;
        $newPermission->save();
        return redirect()->route('permission.index')->withMessage('You Have Successfully Created a Role');
    }

    public function edit($id) {
        //
        $editPermission = Permission::find($id);
 
        return view('cpanel.permission.edit', compact('editPermission'));
    }
 public function update(Request $request, $id) {
        //
        $permissions = Permission::find($id);
        $permissions->name = $request->name;
        $permissions->display_name = $request->display_name;
        $permissions->description = $request->description;
        $permissions->save();
       
        return redirect()->route('permission.index')->withMessage('Role Updated');
    }
    
        public function destroy($id) {
        //
        //$role = Role::find($id);
        DB::table('permissions')->where('id', $id)->delete();
        // $role->delete();

        return back()->withMessage('Role Deleted');
    }

    public function assighRole() {
        $user = User::where('name', '=', 'Admin')->first();


        // or eloquent's original technique
        $done = $user->roles()->attach($user->id); // id only
        // return($done);
    }
}
