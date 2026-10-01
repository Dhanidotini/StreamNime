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
            $table->boolean(column: 'is_trending')
                ->default(false);
            $table->string(column: 'title');
            $table->string(column: 'title_native')
                ->nullable();
            $table->string(column: 'title_english')
                ->nullable();
            $table->json(column: 'titles')
                ->nullable();
            $table->string(column: 'slug')
                ->unique()
                ->index();
            $table->text(column: 'synopsis')
                ->nullable();
            $table->string(column: 'status')
                ->default(StatusEnum::Unknown);
            $table->dateTime('release_date')
                ->nullable();
            $table->float(column: 'rating', precision: 2)
                ->nullable();
            $table->string(column: 'type')
                ->default(TypeEnum::Unknown);
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
