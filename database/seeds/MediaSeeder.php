<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //home
//        Setting::set('home_image_two', '/img/home_image_two.jpeg');
//        Setting::set('home_image_one', '/img/home_image_one.jpeg');
//
//        //services
//        Setting::set('due_diligence', '/img/due_diligence.jpeg');
//        Setting::set('planning_design', '/img/planning_design.jpeg');
//        Setting::set('landscape_gardens', '/img/landscape_gardens.jpeg');
//        Setting::set('general_roofing_works', '/img/general_roofing_works.jpeg');
//        Setting::set('commercial_new_builds_refurbish', '/img/commercial_new_builds_refurbish.jpeg');
//        Setting::set('building_construction_management', '/img/building_construction_management.jpeg');
//
//        Setting::save();

        DB::statement("SET foreign_key_checks = 0");

        Artisan::call('medialibrary:clean');
        Artisan::call('medialibrary:clear');

    }
}
