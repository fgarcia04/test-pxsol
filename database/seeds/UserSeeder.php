<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    protected $data = [
        [
            'name' => 'Lucas',
            'last_name' =>'De Luca'
        ],
        [
            'name' => 'Gaston',
            'last_name' =>'Guillermet'
        ],
        [
            'name' => 'Andres',
            'last_name' => 'Manzanares'
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $user){
            DB::table('users')->insert([
                'name' => $user['name'],
                'last_name' => $user['last_name'],
                'created_at' => Carbon::now()
            ]);
        }
    }
}
