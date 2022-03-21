<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers\DBTypes;

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

            $table->string('email')->unique();
            $table->string('password');
            $table->string('name');
            $table->enum('identification_type',DBTypes::get('identification_type'));
            $table->string('identification_value');
            $table->string('phone');
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
