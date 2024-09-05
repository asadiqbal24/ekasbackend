<?php

namespace App\Services;

interface SettingServiceInterface {
    public static function getSettings();
    public static function getSetting($key);
}