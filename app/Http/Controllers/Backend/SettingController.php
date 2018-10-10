<?php

namespace App\Http\Controllers\Backend;

use Response;
use App\Http\Controllers\AppBaseController;
use anlutro\LaravelSettings\Facade as Setting;


class SettingController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();

        return view('backend.settings.edit', [
            'about' => Setting::get('about'),
            'twitter' => Setting::get('twitter'),
            'facebook' => Setting::get('facebook'),
            'about_image_url' => Setting::get('app_avatar'),
            'app_contact_email' => Setting::get('app_contact_email'),
            'google_analytics_code' => Setting::get('google_analytics_code')
        ]);
    }

}
