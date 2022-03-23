<?php

use App\Helpers\DBSizes;
use App\Helpers\DBTypes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
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

            $table->string('email',DBSizes::STRING)->unique();
            $table->string('password',DBSizes::STRING);
            $table->string('name',DBSizes::STRING)->nullable();
            $table->enum('identification_type',DBTypes::IDENTIFICATION_TYPE)->nullable();
            $table->string('identification_value',DBSizes::STRING)->nullable();
            $table->string('phone')->nullable();
            $table->string('remember_token',DBSizes::TOKEN)->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();

            $table->boolean('is_admin')->default(false);
            
            $table->timestamps();
            $table->unique(['identification_type','identification_value']);
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
};
