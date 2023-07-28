<?php

use App\Models\Client;
use App\Models\Compte;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->integer('montant');
            $table->enum('typeTransfer',['depot','retrait','transfer']);
            $table->enum('operateur',['Orange money','Wave','Wari','CB']);
            $table->unsignedBigInteger('compte_id')->nullable();
            $table->foreign('compte_id')->references('id')->on('comptes')->onDelete('cascade');
            $table->string('code_genere')->unique()->nullable();
            $table->boolean('code')->default(false);
            $table->enum('genreTransac',['code','sans code','permenant','immediate'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
