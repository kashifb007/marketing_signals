<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uri', 1000);
            $table->string('title', 1000)->nullable();
            $table->string('source_code')->nullable();
            $table->string('description', 3000)->nullable();
            $table->string('logo', 500)->nullable();
            $table->string('notes', 1000)->nullable();
            $table->enum('decision', ['Yes', 'No', 'Not Sure'])->default('Yes');
            $table->unsignedSmallInteger('status_code')->default(200); //the status code from attempting to fetch a logo, eg 200 OK
            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
