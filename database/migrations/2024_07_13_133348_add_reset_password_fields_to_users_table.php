<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('reset_password_token')->nullable()->after('password');
        $table->timestamp('token_created_at')->nullable()->after('reset_password_token');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('reset_password_token');
        $table->dropColumn('token_created_at');
    });

    }
};
