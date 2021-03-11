<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsAndAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_and_announcements', function (Blueprint $table) {
            $table->id()->autoIncrement();
<<<<<<< HEAD:thesisProjectApi/database/migrations/2021_03_09_115202_create_events_and_announcements_table.php
            $table->id('userid');
=======
            $table->string('eventOwner');
>>>>>>> b1dfcc5e069a3a12c3f517df7141b97ace68097c:thesisProjectApi/database/migrations/2021_03_11_061431_create_events_and_announcements_table.php
            $table->string('title');
            $table->string('description');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('location');
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
        Schema::dropIfExists('events_and_announcements');
    }
}
