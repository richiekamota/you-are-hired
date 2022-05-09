<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
use App\Models\Candidate;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_candidate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(Company::class)->constrained();
            $table->foreignIdFor(Candidate::class)->constrained();
            $table->enum('status', ['Contacted', 'Hired'])->default('Contacted');
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
        Schema::dropIfExists('company_candidate');
    }
};
