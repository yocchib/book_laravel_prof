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
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();               //  主キー デフォルトで id ($table->id('tweet_id')　で 変更可 
            $table->string('content');   // p54 taka 追加  (VARCHAR 型)
            $table->timestamps();       // create_at と update_at の２つが作成される
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweets');
    }
};
