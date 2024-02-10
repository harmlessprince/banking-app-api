<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->index('transaction_reference_index');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('account_id')->constrained('accounts');
            $table->foreignId('transfer_id')->nullable()->constrained('transfers')->nullOnDelete();
            $table->decimal('amount', 16, 4);
            $table->decimal('balance', 16, 4)->nullable();
            $table->string('category'); // deposit, withdrawal
            $table->boolean('confirmed')->default(0);
            $table->string('description')->nullable();
            $table->dateTime('date');
            $table->text('meta')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
