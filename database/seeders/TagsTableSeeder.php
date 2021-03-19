<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Tag::create(['name' => 'programs']);
      Tag::create(['name' => 'mobile']);
      Tag::create(['name' => 'code']);
      Tag::create(['name' => 'java']);
      Tag::create(['name' => 'C#']);
      Tag::create(['name' => 'tech']);

    }
}
