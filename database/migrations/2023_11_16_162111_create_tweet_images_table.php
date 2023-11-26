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
        Schema::create('tweet_images', function (Blueprint $table) {
          // $table->id();  // 交差テーブルなので id は不要か？ (p222 taka)
          // 外部キー２つ(tweet_id, image_id) カラム追記する     ■P220
          // 外部キーは、外部キー制約(conttrained) と削除連動性(cascadeOnDelete) を定義
          $table->foreignId('tweet_id')->constrained('tweets')->cascadeOnDelete(); // 外部キー(p222 taka)
          $table->foreignId('image_id')->constrained('images')->cascadeOnDelete(); // 外部キー(p222 taka)

          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweet_images');
    }
};
