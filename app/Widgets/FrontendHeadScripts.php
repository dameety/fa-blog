<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use anlutro\LaravelSettings\Facade as Setting;

class FrontendHeadScripts extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return view('frontend.widgets.frontend_head_scripts', [
            'config' => $this->config,
            'google_analytics_code' => Setting::get('google_analytics_code')
        ]);
    }
}
