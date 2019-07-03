<?php

namespace App;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\Model;

class Role extends EntrustRole
{
   // use EntrustRole;
    //
   /* public function __construct()
    {

        $this->EntrustRole = new EntrustRole;
    }*/
    protected $fillable = ['name', 'display_name', 'description','created_at','updated_at'];

     public function permision()
    {
        return $this->belongsToMany('App\Permission');
    }
     public function users()
    {
        return $this->belongsToMany('App\User','role_user','role_id','user_id');
    }
}
