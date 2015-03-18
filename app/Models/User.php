<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{

	protected $fillable = ['name', 'email', 'password', 'status', 'remember_token'];

	public function objections(){
		return $this->hasMany('App\Models\Objection', 'id_user');
	}

	public function worries(){
		return $this->belongsToMany('App\Models\Falla', 'objections', 'id_user', 'id_falla');
	}

}