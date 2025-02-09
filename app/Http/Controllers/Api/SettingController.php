<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingCollection;
use App\Http\Resources\SettingResource;
use App\Models\Settings;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Settings::get();

        return new SettingCollection($setting);

    }
}
