<?php

use App\Enums\Anime\StatusEnum;
use App\Enums\Enums\Anime\TypeEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_trending')->default(false);
            $table->string('title');
            $table->string('slug')
                ->unique()
                ->index();
            $table->text('synopsis')
                ->nullable();
            $table->string('status');
            $table->dateTime('release_date')
                ->nullable();
            $table->float('rating')
                ->nullable();
            $table->string('type')
                ->default(TypeEnum::Unknown);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animes');
    }
};
