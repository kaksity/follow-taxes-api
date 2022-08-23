<?php

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
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->uuid('state_id')->index();
            $table->uuid('lga_id')->index();
            $table->integer('year')->length(4);
            $table->uuid('contractor_id')->index();
            $table->decimal('budget_amount');
            $table->decimal('contract_amount');
            $table->uuid('mda_id')->index();
            $table->uuid('sector_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
