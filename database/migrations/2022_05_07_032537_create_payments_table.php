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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamp('datetime');
            $table->decimal('price')->unsigned();
            $table->enum('payment_method',DBTypes::PAYMENT_METHODS);
            $table->string('status',DBSizes::STRING)->default('pending');
            $table->string('url',DBSizes::STRING)->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreignId('payment_plan_id')->constrained();
            $table->foreignId('user_id')->constrained();

            $table->bigInteger('mercado_pago_id')->nullable()->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
