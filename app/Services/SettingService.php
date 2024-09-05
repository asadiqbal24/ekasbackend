<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\setting;

class SettingService implements SettingServiceInterface 
{
    public static function getSettings()
    {
        $settings = setting::all();
        $settingsArray = [];

        foreach ($settings as $setting) {
            $settingsArray[$setting->key] = $setting->value;
        }

        return $settingsArray;
    }

    public static function getSetting($key)
    {
        return setting::where('key', $key)->first()->value ?? null;
    }
}