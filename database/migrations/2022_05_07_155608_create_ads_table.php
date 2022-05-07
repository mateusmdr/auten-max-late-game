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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', DBSizes::STRING);
            $table->string('link_url',DBSizes::STRING);
            $table->date('begin_at');
            $table->date('end_at');
            $table->decimal('price')->unsigned();
            $table->string('img_filename', DBSizes::STRING);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
};
