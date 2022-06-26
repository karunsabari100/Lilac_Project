<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->unsignedBigInteger('fk_department');
            $table->foreign('fk_department')->references('id')->on('departments')->onDelete('cascade');
            $table->unsignedBigInteger('fk_designation');
            $table->foreign('fk_designation')->references('id')->on('designations')->onDelete('cascade');
            $table->bigInteger('phone_number');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        User::create([
            'id'=>1,
            'name'=>'John Due',
            'fk_department'=>1,
            'fk_designation'=>1,
            'phone_number'=>9562218794,
        ]);

        User::create([
            'id'=>2,
            'name'=>'Tommy Mark',
            'fk_department'=>2,
            'fk_designation'=>2,
            'phone_number'=>9562213494,
        ]);

        User::create([
            'id'=>3,
            'name'=>'James',
            'fk_department'=>3,
            'fk_designation'=>3,
            'phone_number'=>8762213494,
        ]);

        User::create([
            'id'=>4,
            'name'=>'Benjamin',
            'fk_department'=>1,
            'fk_designation'=>1,
            'phone_number'=>8735213494,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
