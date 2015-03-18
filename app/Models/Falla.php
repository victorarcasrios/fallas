<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Falla extends Model{

	protected $fillable = ['name', 'address', 'status'];

	public function objections(){
		return $this->hasMany('App\Models\Objection', 'id_falla');
	}

	public function fools(){
		return $this->belongsToMany('App\Models\User', 'objections', 'id_falla', 'id_user');
	}

}