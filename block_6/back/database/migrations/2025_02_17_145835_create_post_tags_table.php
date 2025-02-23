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
        Schema::create(
            'post_tags', function (Blueprint $table) {

                $table->id();
                // $table->unsignedBigInteger('post_id');
                // $table->unsignedBigInteger('tag_id');

                $table->foreignId('post_id')->constrained()->cascadeOnDelete();
                $table->foreignId('tag_id')->constrained()->cascadeOnDelete();

                $table->timestamps();

                // //IDX
                // $table->index('post_id', 'post_tag_post_idx');
                // $table->index('tag_id', 'post_tag_tag_idx');

                // //FK
                // $table->foreign('post_id', 'post_tag_post_fk')
                //     ->references('id')->on('posts');
                // $table->foreign('tag_id', 'post_tag_tag_fk')
                //     ->references('id') ->on('tags');
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tags');
    }
};
