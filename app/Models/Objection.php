<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objection extends Model{

	protected $fillable = ['id_falla', 'id_user', 'text', 'status'];

	public function author(){
		return $this->belongsTo('App\Models\User');
	}

	public function falla(){
		return $this->belongsTo('App\Models\Falla');
	}

}