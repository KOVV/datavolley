<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    public function up()
{
    $table->increments('id');
    $table->string('firstname', 20);
    $table->string('lastname', 20);
    $table->string('email', 100)->unique();
    $table->string('password', 64);
    $table->timestamps();
}
public function down()
{
    Schema::drop('users');
}
}
