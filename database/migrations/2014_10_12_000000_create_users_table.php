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
            $table->string('cpf',DBSizes::STRING)->nullable()->unique();
            $table->string('phone',DBSizes::STRING)->nullable();

            $table->boolean('is_blocked')->default(false);
            $table->boolean('is_admin')->default(false);

            $table->timestamps();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
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
