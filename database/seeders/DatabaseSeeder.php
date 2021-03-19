<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(PostsTagsTableSeede::class);
        $this->call(PagesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
