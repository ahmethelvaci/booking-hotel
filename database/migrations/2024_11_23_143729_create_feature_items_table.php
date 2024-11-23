<?php

use App\Models\FeatureItem;
use App\Models\Hotel;
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
        Schema::create('feature_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('feature_item_hotel', function (Blueprint $table) {
            $table->foreignIdFor(FeatureItem::class)->constrained()->noActionOnDelete();
            $table->foreignIdFor(Hotel::class)->constrained()->noActionOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_items');
        Schema::dropIfExists('feature_item_hotel');
    }
};
