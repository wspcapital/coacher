<?php

namespace App\Helpers;

class CustomFunction
{

    public static function escapeLikeString($value)
    {
        return str_replace(['\\', '_', '%'], ['\\\\', '\\_', '\\%'], $value);
    }

    public static function getTimezoneList($format = null)
    {
        $timezones = array(
            'Pacific/Midway' => 'Midway Island',
            'Pacific/Samoa' => 'Samoa Time',
            //'Pacific/Honolulu' => 'Honolulu',
            'US/Hawaii' => 'Hawaii Time',
            'US/Alaska' => 'Alaska Time',
            'US/Pacific' => 'Pacific Time (US & Canada)',
            //'America/Los_Angeles' => 'Los Angeles',
            'America/Tijuana' => 'Tijuana',
            'US/Arizona' => 'Arizona',
            'US/Mountain' => 'Mountain Time (US & Canada)',
            'America/Chihuahua' => 'La Paz, Chihuahua',
            'America/Mazatlan' => 'Mazatlan',
            'America/Mexico_City' => 'Mexico City',
            'America/Monterrey' => 'Monterrey',
            'Canada/Saskatchewan' => 'Saskatchewan',
            'America/Managua' => 'Central America',
            'US/Central' => 'Central Time (US & Canada)',
            'America/Bogota' => 'Bogota, Quito',
            'America/Lima' => 'Lima',
            'US/Eastern' => 'Eastern Time (US & Canada)',
            'US/East-Indiana' => 'Indiana (East)',
            'America/Caracas' => 'Caracas',
            'Canada/Atlantic' => 'Atlantic Time (Canada)',
            'America/La_Paz' => 'La Paz',
            'Canada/Newfoundland' => 'Newfoundland',
            'America/Santiago' => 'Santiago',
            'America/Sao_Paulo' => 'Brasilia',
            'America/Buenos_Aires' => 'Buenos Aires',
            'America/Godthab' => 'Greenland',
            'America/Noronha' => 'Mid-Atlantic',
            'Atlantic/Azores' => 'Azores',
            'Atlantic/Cape_Verde' => 'Cape Verde Is.',
            'UTC' => 'UTC',
            'Etc/Greenwich' => 'Greenwich Mean Time',
            'Europe/Dublin' => 'Dublin',
            'Europe/London' => 'London',
            'Europe/Lisbon' => 'Lisbon',
            'Africa/Casablanca' => 'Casablanca',
            'Africa/Monrovia' => 'Monrovia',
            'Europe/Amsterdam' => 'Amsterdam',
            'Europe/Berlin' => 'Berlin, Bern',
            'Europe/Vienna' => 'Vienna',
            'Europe/Rome' => 'Rome',
            'Europe/Stockholm' => 'Stockholm',
            'Europe/Belgrade' => 'Belgrade',
            'Europe/Bratislava' => 'Bratislava',
            'Europe/Budapest' => 'Budapest',
            'Europe/Ljubljana' => 'Ljubljana',
            'Europe/Prague' => 'Prague',
            'Europe/Brussels' => 'Brussels',
            'Europe/Copenhagen' => 'Copenhagen',
            'Europe/Madrid' => 'Madrid',
            'Europe/Paris' => 'Paris',
            'Europe/Warsaw' => 'Warsaw',
            'Europe/Zagreb' => 'Zagreb',
            'Europe/Sarajevo' => 'Sarajevo',
            'Europe/Skopje' => 'Skopje',
            'Africa/Lagos' => 'West Central Africa',
            'Europe/Athens' => 'Athens',
            'Europe/Bucharest' => 'Bucharest',
            'Africa/Harare' => 'Harare',
            'Europe/Vilnius' => 'Vilnius',
            'Europe/Kiev' => 'Kiev',
            'Europe/Riga' => 'Riga',
            'Europe/Sofia' => 'Sofia',
            'Europe/Tallinn' => 'Tallinn',
            'Europe/Helsinki' => 'Helsinki',
            'Asia/Jerusalem' => 'Jerusalem',
            'Africa/Cairo' => 'Cairo',
            'Europe/Istanbul' => 'Istanbul',
            'Africa/Johannesburg' => 'Pretoria',
            'Asia/Baghdad' => 'Baghdad',
            'Europe/Minsk' => 'Minsk',
            'Asia/Kuwait' => 'Kuwait',
            'Asia/Riyadh' => 'Riyadh',
            'Africa/Nairobi' => 'Nairobi',
            'Europe/Volgograd' => 'Volgograd',
            'Europe/Moscow' => 'Moscow, St. Petersburg',
            'Asia/Tehran' => 'Tehran',
            'Asia/Muscat' => 'Muscat',
            'Asia/Baku' => 'Baku',
            'Asia/Yerevan' => 'Yerevan',
            'Asia/Tbilisi' => 'Tbilisi',
            'Asia/Kabul' => 'Kabul',
            'Asia/Karachi' => 'Karachi',
            'Asia/Tashkent' => 'Tashkent',
            'Asia/Yekaterinburg' => 'Yekaterinburg',
            'Asia/Calcutta' => 'Sri Jayawardenepura',
            'Asia/Kolkata' => 'Kolkata',
            'Asia/Katmandu' => 'Kathmandu',
            'Asia/Almaty' => 'Almaty',
            'Asia/Dhaka' => 'Dhaka',
            'Asia/Novosibirsk' => 'Novosibirsk',
            'Asia/Urumqi' => 'Urumqi',
            'Asia/Rangoon' => 'Rangoon',
            'Asia/Bangkok' => 'Hanoi',
            'Asia/Jakarta' => 'Jakarta',
            'Asia/Krasnoyarsk' => 'Krasnoyarsk',
            'Asia/Hong_Kong' => 'Hong Kong',
            'Asia/Chongqing' => 'Chongqing',
            'Asia/Kuala_Lumpur' => 'Kuala Lumpur',
            'Australia/Perth' => 'Perth',
            'Asia/Singapore' => 'Singapore',
            'Asia/Taipei' => 'Taipei',
            'Asia/Ulan_Bator' => 'Ulaan Bataar',
            'Asia/Irkutsk' => 'Irkutsk',
            'Asia/Tokyo' => 'Tokyo',
            'Asia/Seoul' => 'Seoul',
            'Asia/Yakutsk' => 'Yakutsk',
            'Australia/Adelaide' => 'Adelaide',
            'Australia/Darwin' => 'Darwin',
            'Australia/Brisbane' => 'Brisbane',
            'Australia/Canberra' => 'Canberra',
            'Pacific/Guam' => 'Guam',
            'Australia/Hobart' => 'Hobart',
            'Australia/Melbourne' => 'Melbourne',
            'Pacific/Port_Moresby' => 'Port Moresby',
            'Australia/Sydney' => 'Sydney',
            'Asia/Vladivostok' => 'Vladivostok',
            'Asia/Magadan' => 'Magadan',
            'Pacific/Auckland' => 'Wellington, Auckland',
            'Pacific/Fiji' => 'Fiji',
            'Pacific/Kwajalein' => 'Marshall Is.',
            'Asia/Kamchatka' => 'Kamchatka',
            'Pacific/Tongatapu' => "Nuku'alofa",
        );

        if (!is_null($format)) {
            foreach ($timezones as $timezone => $title) {
                $timezones[$timezone] = self::getTimezoneFormat($format, $timezone, $title);
            }
        }

        return $timezones;
    }

    /**
     * Get the current offset and dst for the given timezone id
     *
     * @param   string  $timezone
     * @return  array
     */
    public static function getTimezoneData($timezone)
    {
        try {
            $date = new \DateTime('now', new \DateTimeZone($timezone));
            $dst = (bool) $date->format('I');
            $offset_dst = $date->getOffset();
            $offset = $dst ? $offset_dst - 3600 : $offset_dst;
            $offset_pretty_dst = 'UTC' . $date->format('P');
            $offset_pretty = $dst
                ? 'UTC' . ($offset < 0 ? '-' : '+') . gmdate('H:i', abs($offset))
                : $offset_pretty_dst;
        } catch (Exception $e) {
        }

        return [
            'timezone'          => isset($date)              ? $date->getTimezone()->getName() : null,
            'abbr'              => isset($date)              ? $date->format('T') : null,
            'dst'               => isset($dst)               ? $dst : null,
            'offset_dst'        => isset($offset_dst)        ? $offset_dst : null,
            'offset'            => isset($offset)            ? $offset : null,
            'offset_pretty_dst' => isset($offset_pretty_dst) ? $offset_pretty_dst : null,
            'offset_pretty'     => isset($offset_pretty)     ? $offset_pretty : null,
        ];
    }

    public static function getTimezoneFormat($format, $timezone = null, $title = null)
    {
        if (is_null($timezone)) {
            $timezone = with(new DateTime)->getTimezone()->getName();
        }

        $data = self::getTimezoneData($timezone);
        $replace = [
            '{e}' => $timezone,
            '{T}' => array_get($data, 'abbr'),
            '{I}' => array_get($data, 'dst') ? 'Yes' : 'No',
            '{Z}' => array_get($data, 'offset_dst'),
            '{z}' => array_get($data, 'offset'),
            '{P}' => array_get($data, 'offset_pretty_dst'),
            '{p}' => array_get($data, 'offset_pretty'),
            '{t}' => is_null($title) ? array_get(self::getTimezoneList(), $timezone, $timezone): $title,
        ];

        return str_replace(array_keys($replace), array_values($replace), $format);
    }

    public static function getPaymentTypes()
    {
        $types = Config::get('payment.types');

        foreach ($types as $type => $data) {
            $types[$type] = array_only($data, ['description', 'price', 'label']);
        }

        return json_encode($types);
    }

    public static function getPaymentCurrencies()
    {
        return json_encode(Config::get('payment.currencies'));
    }

    public static function getCurrenciesList()
    {
        return array_keys(Config::get('payment.currencies'));
    }

    /**
     * Escape symbols in a string for ng-init attribute.
     *
     * @param  string  $value
     * @return string
     */
    public static function ng($value)
    {
        return $value ? trim(json_encode($value, JSON_HEX_TAG
            | JSON_HEX_APOS
            | JSON_HEX_QUOT
            | JSON_HEX_AMP), '"')
        : $value;
    }
}
