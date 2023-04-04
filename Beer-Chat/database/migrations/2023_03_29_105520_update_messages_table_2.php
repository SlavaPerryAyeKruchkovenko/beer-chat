<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMessagesTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'messages',
            function (Blueprint $table) {
                $table->timestamp('updated_at');
                $table->timestamp('created_at');
            }
        );
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'messages',
            function (Blueprint $table) {
                $table->dropColumn('updated_at');
                $table->dropColumn('created_at');
            }
        );
    }
}
