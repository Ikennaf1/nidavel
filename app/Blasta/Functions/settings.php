<?php

require_once base_path('/app/Blasta/Classes/Settings.php');

/**
 * Get settings instance
 */
function getSettings()
{
    return Settings::getInstance();
}


/**
 * A cleaner way of returning values for settings using dot notation
 */
function settings(string $settings, string $default = ''): string
{
    $allSettings    = Settings::getInstance();
    $allSettings    = $allSettings->all();
    $settings       = explode('.', $settings);
    $key            = $settings[0];
    $setting        = $settings[1];

    if (!empty($allSettings[$key][$setting])) {
        return $allSettings[$key][$setting];
    } else {
        return $default;
    }

    return null;
}
