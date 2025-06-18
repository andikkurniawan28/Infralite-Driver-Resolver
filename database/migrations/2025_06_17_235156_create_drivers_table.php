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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained();
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('operation_system_id')->constrained();
            $table->string('architecture'); // 32bit atau 64bit
            $table->string('serial_number')->nullable(); // serial perangkat, tidak wajib
            $table->string('name')->unique(); // nama driver
            $table->string('version')->nullable(); // versi driver jika tersedia
            $table->string('download_url'); // URL resmi ke halaman vendor (bukan file langsung)
            $table->enum('status', ['active', 'inactive', 'deprecated'])->default('active');
            $table->text('notes')->nullable(); // catatan tambahan seperti instruksi install
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
