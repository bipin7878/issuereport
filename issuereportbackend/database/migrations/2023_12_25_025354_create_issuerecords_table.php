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
        Schema::create('issuerecords', function (Blueprint $table) {
            $table->id();
            $table->string('issuetitle');
            $table->text('description');
            $table->json('attached_files')->nullable();
            $table->enum('priority', ['highest', 'high', 'medium', 'low', 'lowest']);
            $table->string('reportedname');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('issuerecords');
        Schema::table('issuerecords', function (Blueprint $table) {
            //$table->dropColumn('image_path'); // Remove the image_path column on rollback
        });
    }
};
