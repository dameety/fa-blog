<?php

use Illuminate\Database\Seeder;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        DB::table('subscribers')->delete();

        factory(\App\Models\Subscriber::class, 11)->create();

        $subscribers = \App\Models\Subscriber::all();

        foreach($subscribers as $subscriber) {
            Newsletter::subscribe($subscriber->email);
        }
    }
}
