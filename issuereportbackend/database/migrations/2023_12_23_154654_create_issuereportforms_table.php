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
        Schema::create('issuereportforms', function (Blueprint $table) {
            $table->id();
            $table->string('issuetitle');
            $table->string('description');
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
       // Schema::dropIfExists('issuereportforms');
        
            Schema::table('issuereportforms', function (Blueprint $table) {
                //$table->dropColumn('image_path'); // Remove the image_path column on rollback
            });
        
    }
};
