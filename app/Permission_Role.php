<?php

namespace App;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends EntrustRole {

    // use EntrustRole;
    //
   /* public function __construct()
      {

      $this->EntrustRole = new EntrustRole;
      } */
    protected $table = "permission_role";

    public function ralations() {
        return $this->belongsToMany('App\Role', 'permission_role', 'permission_id', 'role_id');
    }

}
