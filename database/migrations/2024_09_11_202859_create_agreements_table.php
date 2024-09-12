<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_address');
            $table->string('client_phone');
            $table->string('client_email');
            $table->string('project_name');
            $table->string('project_type');
            $table->date('project_start_date');
            $table->date('project_delivery_date');
            $table->json('documents')->nullable();
            $table->string('cash_transaction_name')->nullable();
            $table->string('cash_transaction_to')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('mobile_banking')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agreements');
    }
};
