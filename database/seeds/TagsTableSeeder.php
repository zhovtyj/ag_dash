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


//        $tag1 = new Tag();
//        $tag1->name = 'Account Created';
//        $tag1->save();
//
//        $tag2 = new Tag();
//        $tag2->name = 'Ready To Sell';
//        $tag2->save();
//
//        $tag3 = new Tag();
//        $tag3->name = 'In Progress';
//        $tag3->save();
//
//        $tag4 = new Tag();
//        $tag4->name = 'Follow Up Needed';
//        $tag4->save();
//
//        $tag5 = new Tag();
//        $tag5->name = 'Closed (Won)';
//        $tag5->save();
//
//        $tag6 = new Tag();
//        $tag6->name = 'Closed (Lost)';
//        $tag6->save();

    }
}
