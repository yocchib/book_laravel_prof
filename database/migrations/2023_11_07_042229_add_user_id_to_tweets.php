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
        Schema::table('tweets', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id')->after('id');   // p127 taka (誰がつぶやいたかわかるように USER_IDを追加する)
                    
            // usersテーブルのidカラムにuser_idカラムを関連付けます。
            $table->foreign('user_id')->references('id')->on('users'); // p127 taka (外部キー制約)

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tweets', function (Blueprint $table) {
            //
            $table->dropForeign('tweets_user_id_foreign');  // p127 taka
            $table->dropColumn('user_id');                  // p127 taka

        });
    }
};
