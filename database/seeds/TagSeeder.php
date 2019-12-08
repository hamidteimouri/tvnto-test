<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
        DB::table("tags")->truncate();
        DB::table("post_tag")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS = 1;");

        factory(Tag::class, 10)->create();

    }
}
