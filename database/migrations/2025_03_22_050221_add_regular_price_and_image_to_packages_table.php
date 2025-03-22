<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->decimal('regular_price', 10, 2)->after('price')->nullable();
            $table->string('image')->after('regular_price')->nullable();
        });
    }

    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('regular_price');
            $table->dropColumn('image');
        });
    }
};
