<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedTinyInteger('castle_level')->nullable()->after('category');
            $table->unsignedBigInteger('might')->nullable()->after('castle_level');
            $table->unsignedInteger('troop_t4')->nullable()->after('might');
            $table->unsignedInteger('troop_t5')->nullable()->after('troop_t4');
            $table->string('kingdom', 50)->nullable()->after('troop_t5');
            $table->string('account_role', 50)->nullable()->after('kingdom');
            $table->string('bind_status', 50)->nullable()->after('account_role');
            $table->boolean('migration_ticket_ready')->default(false)->after('bind_status');
            $table->string('hero_grade', 120)->nullable()->after('migration_ticket_ready');
            $table->string('familiar_grade', 120)->nullable()->after('hero_grade');
            $table->text('research_summary')->nullable()->after('familiar_grade');

            $table->index('castle_level');
            $table->index('might');
            $table->index('account_role');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['castle_level']);
            $table->dropIndex(['might']);
            $table->dropIndex(['account_role']);
            $table->dropColumn([
                'castle_level',
                'might',
                'troop_t4',
                'troop_t5',
                'kingdom',
                'account_role',
                'bind_status',
                'migration_ticket_ready',
                'hero_grade',
                'familiar_grade',
                'research_summary',
            ]);
        });
    }
};
