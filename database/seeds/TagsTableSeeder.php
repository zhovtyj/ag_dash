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
        $tag1->name = 'Urgent';
        $tag1->save();

        $tag2 = new Tag();
        $tag2->name = 'Local SEO';
        $tag2->save();

        $tag3 = new Tag();
        $tag3->name = 'National SEO';
        $tag3->save();

        $tag4 = new Tag();
        $tag4->name = 'Link Building';
        $tag4->save();

        $tag4 = new Tag();
        $tag4->name = 'GMB Optimization';
        $tag4->save();

        $tag4 = new Tag();
        $tag4->name = 'Reputation Mgmnt';
        $tag4->save();

        $tag4 = new Tag();
        $tag4->name = 'Biz Listing Mgmnt';
        $tag4->save();

        $tag4 = new Tag();
        $tag4->name = 'Social Media Mgmnt';
        $tag4->save();

        $tag4 = new Tag();
        $tag4->name = 'Content and PR News';
        $tag4->save();

        $tag4 = new Tag();
        $tag4->name = 'PPC and Paid Traffic';
        $tag4->save();
        
    }
}
