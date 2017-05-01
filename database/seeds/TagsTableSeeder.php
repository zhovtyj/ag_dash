<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag1 = new Tag();
        $tag1->name = 'wholesale';
        $tag1->save();

        $tag2 = new Tag();
        $tag2->name = 'mmbb';
        $tag2->save();

        $tag3 = new Tag();
        $tag3->name = 'whitelabel';
        $tag3->save();

        $tag4 = new Tag();
        $tag4->name = 'irank';
        $tag4->save();

    }
}
