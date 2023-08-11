<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_add_user_id_to_books.php

public function up()
{
    Schema::table('books', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable()->after('id');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('books', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}

};
