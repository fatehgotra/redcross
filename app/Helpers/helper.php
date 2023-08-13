<?php

use App\Models\AdminSettings;

function get_setting($key)
{

    $meta = AdminSettings::where([

        'setting_key' => $key,
    ])->get()->first();
    if (empty($meta)) {

        return null;
    } else {
        $meta = $meta->setting_value;
    }

    return $meta;
}