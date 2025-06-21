<?php

namespace App\Enums;

enum Model: string
{
    case USER = 'user';
    case VEHICLE_MAKE = 'vehicle-make';
    case VEHICLE_MODEL = 'vehicle-model';
    case VEHICLE_TYPE = 'vehicle-type';
    case ZOHO_OAUTH_ACCESS_TOKEN = 'zoho-oauth-access-token';
    case ZOHO_OAUTH_REFRESH_TOKEN = 'zoho-oauth-refresh-token';

    public function getLabel(): string
    {
        return match ($this) {
            self::USER => __('User'),
            self::VEHICLE_MAKE => __('Vehicle Make'),
            self::VEHICLE_MODEL => __('Vehicle Model'),
            self::VEHICLE_TYPE => __('Vehicle Type'),
            self::ZOHO_OAUTH_ACCESS_TOKEN => __('Zoho OAuth Access Token'),
            self::ZOHO_OAUTH_REFRESH_TOKEN => __('Zoho OAuth Refresh Token'),
        };
    }
}
