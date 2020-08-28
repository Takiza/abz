<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('emp_date')->default(\Carbon\Carbon::now());
            $table->string('phone');
            $table->string('email')->unique();
            $table->double('wage')->default(0);
            $table->string('photo')->nullable();
            $table->integer('admin_created_id')->unsigned()->nullable();
            $table->integer('admin_updated_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
