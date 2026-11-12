<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->unique()->constrained('users')->nullOnDelete();
            $table->string('telefono', 20)->nullable()->change();
        });

        $clientes = DB::table('clientes')
            ->join('users', 'users.email', '=', 'clientes.email')
            ->where('users.role', 'cliente')
            ->select('clientes.id as cliente_id', 'users.id as user_id')
            ->get();

        foreach ($clientes as $cliente) {
            DB::table('clientes')
                ->where('id', $cliente->cliente_id)
                ->update(['user_id' => $cliente->user_id]);
        }
    }

    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropUnique(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
