<?php

use App\Helpers\DBSizes;
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
        Schema::create('tournament_recurrences', function (Blueprint $table) {
            $table->id();
            $table->string('schedule',DBSizes::STRING);
            $table->date('ends_at');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->foreignId('tournament_recurrence_id')->nullable()->constrained()->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournament_recurrences');
    }
};
