<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Designation;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $unity = Designation::create(['designation_name' => 'unity']);
            $laravel = Designation::create(['designation_name' => 'laravel']);
            $hr = Designation::create(['designation_name' => 'hr']);
            $node = Designation::create(['designation_name' => 'node']);  


            
    }
}