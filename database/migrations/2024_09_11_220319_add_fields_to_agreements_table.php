<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('agreements', function (Blueprint $table) {


            $table->string('bank_transaction_id')->nullable()->after('account_number');

            $table->string('mobile_banking_id')->nullable()->after('mobile_banking');

        });
    }
    public function down(): void
    {
        Schema::table('agreements', function (Blueprint $table) {

        });
    }
};
