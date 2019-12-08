<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Post;

class CategoryAndPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
        DB::table("categories")->truncate();
        DB::table("posts")->truncate();
        DB::table("post_tag")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS = 1;");

        # create category
        factory(Category::class, 10)->create()->each(function ($obj) {

            # create sub-category
            $rand = rand(1, 5);
            factory(Category::class, $rand)->create(['parent_id' => $obj->id])->each(function ($object) {

                $r = rand(1, 10);
                factory(Post::class, $r)->create(['category_id' => $object->id]);
            });

        });
    }
}
