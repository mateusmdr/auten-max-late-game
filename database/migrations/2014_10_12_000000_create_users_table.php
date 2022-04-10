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

            $table->string('name',DBSizes::STRING);
            $table->string('email',DBSizes::STRING)->unique();
            $table->string('password',DBSizes::STRING);
            $table->enum('identification_type',DBTypes::IDENTIFICATION_TYPE)->nullable();
            $table->string('identification_value',DBSizes::STRING)->nullable();
            $table->string('phone',DBSizes::STRING)->nullable();
            
            $table->boolean('is_admin')->default(false);

            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            
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