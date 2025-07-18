<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndIsFeaturedToRoomsTable extends Migration
{
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->enum('status', ['draft', 'active', 'archived'])->default('draft')->after('size');
            $table->boolean('is_featured')->default(false)->after('status');
        });
    }

    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('is_featured');
        });
    }
}
