<?php

namespace App\Http\Controllers\Ajax;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use anlutro\LaravelSettings\Facade as Setting;

class SettingController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->has('app_avatar')) {
            $avatar = $this->saveImage($request);
            Setting::set('app_avatar',  asset('/media/' . $avatar));
        }

        Setting::set('about', $request->about);
        Setting::set('app_contact_email', $request->contact_email);
        Setting::set('facebook', $request->facebook);
        Setting::set('twitter', $request->twitter);
        Setting::set('google_analytics_code', $request->google_analytics_code);

        Setting::save();

        return $this->sendResponse([], 'Setting updated successfully.');

    }

    private function saveImage ($request)
    {
        $imageData = $request->app_avatar;
        $data = base64_decode( explode(',', $imageData)[1] );

        if ( strpos($imageData, 'png') !== false ) {
            $fileName = 'app_avatar' . '.png';
            $file = public_path() . '/media/' . $fileName;
            file_put_contents($file, $data);
            return $fileName;
        } else {
            $fileName = 'app_avatar' . '.jpeg';
            $file = public_path() . '/media/' . $fileName;
            file_put_contents($file, $data);
            return $fileName;
        }
    }
}
