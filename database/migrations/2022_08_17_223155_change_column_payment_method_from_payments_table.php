<?php

use App\Helpers\DBTypes;
use App\Models\Payment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('payment_method')->change();
        });
        DB::statement("ALTER TABLE payments DROP CONSTRAINT payments_payment_method_check");

        DB::statement("ALTER TABLE users DROP CONSTRAINT users_payment_method_check");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
