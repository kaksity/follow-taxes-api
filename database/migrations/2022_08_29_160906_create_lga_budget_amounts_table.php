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
        Schema::create('lga_budget_amounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('budget_item_id')->index();
            $table->uuid('lga_id')->index();
            $table->string('proposed_amount');
            $table->string('approved_amount');
            $table->string('revised_amount');
            $table->string('actual_amount');
            $table->string('year');
            $table->softDeletes();
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
        Schema::dropIfExists('lga_budget_amounts');
    }
};
