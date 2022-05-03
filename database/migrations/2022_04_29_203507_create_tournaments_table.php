<?php

use App\Helpers\DBSizes;
use App\Helpers\DBTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name', DBSizes::STRING);
            $table->decimal('prize')->unsigned();
            $table->integer('min_buy_in')->unsigned();
            $table->integer('max_buy_in')->unsigned();
            $table->date('date');
            $table->time('subscription_begin_at');
            $table->time('subscription_end_at');
            $table->boolean('is_approved')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreignId('tournament_type_id')->constrained();
            $table->foreignId('tournament_platform_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournaments');
    }
};
