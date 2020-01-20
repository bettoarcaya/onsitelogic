<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'event_name'     => 'Event One',
            'event_description'     => 'Event One description'
        ]);

        DB::table('events')->insert([
            'event_name'     => 'Event Two',
            'event_description'     => 'Event Two description'
        ]);

        DB::table('events')->insert([
            'event_name'     => 'Event Three',
            'event_description'     => 'Event Three description'
        ]);
    }
}
