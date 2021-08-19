<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Note;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory(1)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Tag::factory(10)->create();
        \App\Models\Note::factory(10)->create();



        for ($i = 1; $i <= 10; $i++) {
            DB::table('note_tag')->insert([
                'note_id' => Note::all()->random()->id,
                'tag_id' => Tag::all()->random()->id,
            ]);
        }
    }
}