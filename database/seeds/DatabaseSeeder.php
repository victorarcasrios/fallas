<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Falla;
use App\Models\Objection;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('UserTableSeeder');
		$this->call('FallaTableSeeder');
		$this->call('ObjectionTableSeeder');
	}

}

class UserTableSeeder extends Seeder{

	public function run()
	{
		DB::table('users')->truncate();

		User::create([
			'name' => 'victor', 
			'email' => 'victor@gmail.com', 
			'password' => Hash::make('victor'), 
			'status' => 1, 
			'remember_token' => null
			]);

		foreach(['waldo', 'miguel', 'jose', 'david', 'luis'] as $user)
			User::create([ 
				'name' => $user, 
				'email' => "{$user}@gmail.com", 
				'password' => Hash::make($user), 
				'status' => 0, 
				'remember_token' => csrf_token() 
				]);
	}

}

class ObjectionTableSeeder extends Seeder{

	public function run()
	{
		DB::table('fallas')->truncate();

		for($i = 0; $i < 5; $i++)
			Falla::create([
				'name' => "Falla {$i}", 
				'address' => "Calle {$i}, 4{$i}60{$i} Valencia", 
				'status' => 1
				]);
	}
}

class FallaTableSeeder extends Seeder{

	public function run()
	{
		DB::table('objections')->truncate();

		for($i = 5; $i > 0; $i--)
			Objection::create([
				'id_falla' => $i, 
				'id_user' => $i, 
				'text' => "El Caloret Faller", 
				'status' => 1
				]);
	}
}