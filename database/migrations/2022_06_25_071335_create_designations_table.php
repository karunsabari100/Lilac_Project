<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Designation;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
           // $table->timestamps();
        });

        Designation::create([
            'id'=>1,
            'name'=>'Marketing Manager',
        ]);

        Designation::create([
            'id'=>2,
            'name'=>'Mobile Application Developer',
        ]);

        Designation::create([
            'id'=>3,
            'name'=>'Web Developer',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designations');
    }
};
