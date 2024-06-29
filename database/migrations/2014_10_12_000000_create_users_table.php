<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->nullable()->constrained();
            $table->foreignId('batch_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('education')->nullable();
            $table->date('dob')->nullable();
            $table->date('admission_date')->nullable();
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->string('cnic')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('otp')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('fax')->nullable();
            $table->text('notes')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('reset_password_token')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_active')->default(1)->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
