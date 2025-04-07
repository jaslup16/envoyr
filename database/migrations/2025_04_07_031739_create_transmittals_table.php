<?php

use App\Models\Office;
use App\Models\Section;
use App\Models\User;
use App\Models\Document;
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
        Schema::create('transmittals', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(Document::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Office::class, 'from_office_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Office::class, 'to_office_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Section::class, 'from_section_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Section::class, 'to_section_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'from_user_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'to_user_id')->constrained()->cascadeOnDelete();
            $table->text('remarks');
            $table->datetime('date_sent');
            $table->datetime('date_received');
            $table->boolean('pick_up')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transmittals');
    }
};
