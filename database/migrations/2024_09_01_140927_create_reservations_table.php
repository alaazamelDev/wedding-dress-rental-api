<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('dress_id')
                ->constrained('dresses')
                ->cascadeOnDelete();

            $table->date('start_date');

            // the date when the dress is expected to be returned.
            $table->date('expected_due_date');

            // the price that is expected to be paid.
            $table->double('expected_rental_price');

            // the date when the dress IS returned
            $table->date('end_date')->nullable();

            $table->double('rental_price_per_day');

            $table->double('total_rental_price')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
