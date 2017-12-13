<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
        });

        // UserRole::create(['id' => 1,  'name' => 'Admin'                 ]) ;
        // UserRole::create(['id' => 2,  'name' => 'Doctor'                ]) ;
        // UserRole::create(['id' => 3,  'name' => 'Secretary'             ]) ;
        // UserRole::create(['id' => 4,  'name' => 'Patient'               ]) ;
        // UserRole::create(['id' => 5,  'name' => 'Pharmacist'            ]) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
