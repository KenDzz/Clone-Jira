<?php

use App\Enums\CommentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn("comment_id" );
            $table->dropColumn("type");
            $table->integer("commentable_id")->unique();
            $table->enum("commentable_type" ,[CommentType::Project, CommentType::Task]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->string("comment_id")->unique();
            $table->enum("type" ,[CommentType::Project, CommentType::Task]);
            $table->dropColumn("commentable_id" );
            $table->dropColumn("commentable_type" );

        });
    }
};
