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
        Schema::create('payment_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name',DBSizes::STRING);
            $table->decimal('price')->unsigned();
            $table->enum('period',DBTypes::PAYMENT_PERIODS)->unique();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('payment_plan_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_plans');
    }
};
