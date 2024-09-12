<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('agreements', function (Blueprint $table) {
            $table->string('quotation_confirmation')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('advance_amount', 10, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->decimal('remaining_project_amount', 10, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('agreements', function (Blueprint $table) {
            $table->dropColumn([
                'quotation_confirmation',
                'total_amount',
                'advance_amount',
                'payment_method',
                'remaining_project_amount',
            ]);
        });
    }

};
