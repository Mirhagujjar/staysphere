<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;
// use Illuminate\Support\Facades\DB;

// return new class extends Migration {
//     public function up(): void
//     {
//         Schema::table('reservations', function (Blueprint $table) {
//     if (!Schema::hasColumn('reservations', 'user_id')) {
//         $table->unsignedBigInteger('user_id')->nullable()->after('id');
//     }

//     // Also ensure the FK is safe:
//     if (!\DB::select("SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'reservations' AND COLUMN_NAME = 'user_id' AND REFERENCED_TABLE_NAME = 'users'")) {
//         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//     }

//     // Drop + re-add room FK
//     $table->dropForeign(['room_id']);
//     $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');

//     // Add other changes safely
//     if (!Schema::hasColumn('reservations', 'room_type')) {
//         $table->string('room_type')->nullable()->after('check_out');
//     }

//     if (!Schema::hasColumn('reservations', 'deleted_at')) {
//         $table->softDeletes();
//     }

//     if (!Schema::hasColumn('reservations', 'service_id')) {
//         $table->unsignedBigInteger('service_id')->nullable()->after('guests');
//     }
// });

//     }

//     public function down(): void
//     {
//         Schema::table('reservations', function (Blueprint $table) {
//             $table->dropForeign(['room_id']);
//             $table->dropForeign(['user_id']);
//             $table->dropColumn(['user_id', 'room_type', 'service_id']);
//             $table->dropSoftDeletes();

//             // Optional: you could re-add the original foreign key if needed
//             $table->foreign('room_id')
//                 ->references('id')
//                 ->on('rooms')
//                 ->onDelete('cascade');
//         });
//     }
// };


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Step 1: Add user_id column if it doesn't exist
        if (!Schema::hasColumn('reservations', 'user_id')) {
            Schema::table('reservations', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            });
        }

        // Step 2: Add foreign key if not already present
        $foreignExists = DB::select("
            SELECT * FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_NAME = 'reservations'
              AND COLUMN_NAME = 'user_id'
              AND REFERENCED_TABLE_NAME = 'users'
        ");

        if (empty($foreignExists)) {
            Schema::table('reservations', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

        // Step 3: Drop + re-add room FK
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });

        // Step 4: Add other columns if not already present
        Schema::table('reservations', function (Blueprint $table) {
            if (!Schema::hasColumn('reservations', 'room_type')) {
                $table->string('room_type')->nullable()->after('check_out');
            }

            if (!Schema::hasColumn('reservations', 'deleted_at')) {
                $table->softDeletes();
            }

            if (!Schema::hasColumn('reservations', 'service_id')) {
                $table->unsignedBigInteger('service_id')->nullable()->after('guests');
            }
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['room_id']);
            $table->dropColumn(['user_id', 'room_type', 'service_id']);
            $table->dropSoftDeletes();

            // Optionally re-add original FK
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }
};
