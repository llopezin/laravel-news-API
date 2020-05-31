<?php
require 'vendor/autoload.php';

use App\Author;
use App\Category;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('App\News');
        $author_ids = Author::all()->pluck('id')->toArray();
        $category_ids = Category::all()->pluck('id')->toArray();

        for ($i = 0; $i <= 100; $i++) {
            DB::table("news")->insert([
                'title' => $faker->unique()->sentence(),
                'author_id' => $faker->randomElement($author_ids),
                'date-published' => $faker->dateTimeThisDecade($max = 'now', $timezone = null)->format("Y-m-d"),
                'content' => implode($faker->paragraphs(15, false)),
                'imgURL' => $faker->imageUrl($width = 900, $height = 480),
                'category_id' => $faker->randomElement($category_ids),
            ]);
        }
    }
}
