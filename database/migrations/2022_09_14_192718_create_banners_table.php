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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title', DBSizes::STRING);
            $table->string('link_url',DBSizes::STRING);
            $table->string('img_filename', DBSizes::STRING);
            $table->unsignedSmallInteger('position')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
};
