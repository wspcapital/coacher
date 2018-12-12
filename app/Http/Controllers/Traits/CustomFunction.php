<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 27.12.16
 * Time: 17:40
 */

namespace App\Http\Controllers\Traits;

trait CustomFunction
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
     * @param   string $timezone
     * @return  array
     */
    public static function getTimezoneData($timezone)
    {
        try {
            $date = new \DateTime('now', new \DateTimeZone($timezone));
            $dst = (bool)$date->format('I');
            $offset_dst = $date->getOffset();
            $offset = $dst ? $offset_dst - 3600 : $offset_dst;
            $offset_pretty_dst = 'UTC' . $date->format('P');
            $offset_pretty = $dst
                ? 'UTC' . ($offset < 0 ? '-' : '+') . gmdate('H:i', abs($offset))
                : $offset_pretty_dst;
        } catch (Exception $e) {
        }

        return [
            'timezone' => isset($date) ? $date->getTimezone()->getName() : null,
            'abbr' => isset($date) ? $date->format('T') : null,
            'dst' => isset($dst) ? $dst : null,
            'offset_dst' => isset($offset_dst) ? $offset_dst : null,
            'offset' => isset($offset) ? $offset : null,
            'offset_pretty_dst' => isset($offset_pretty_dst) ? $offset_pretty_dst : null,
            'offset_pretty' => isset($offset_pretty) ? $offset_pretty : null,
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
            '{t}' => is_null($title) ? array_get(self::getTimezoneList(), $timezone, $timezone) : $title,
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
     * @param  string $value
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

    public static function country($id = null)
    {
        $country_list = [
            '1'   => "Afghanistan",
            '2'   => "Albania",
            '3'   => "Algeria",
            '4'   => "Andorra",
            '5'   => "Angola",
            '6'   => "Antigua and Barbuda",
            '7'   => "Argentina",
            '8'   => "Armenia",
            '9'   => "Australia",
            '10'  => "Austria",
            '11'  => "Azerbaijan",
            '12'  => "Bahamas",
            '13'  => "Bahrain",
            '14'  => "Bangladesh",
            '15'  => "Barbados",
            '16'  => "Belarus",
            '17'  => "Belgium",
            '18'  => "Belize",
            '19'  => "Benin",
            '20'  => "Bhutan",
            '21'  => "Bolivia",
            '22'  => "Bosnia and Herzegovina",
            '23'  => "Botswana",
            '24'  => "Brazil",
            '25'  => "Brunei",
            '26'  => "Bulgaria",
            '27'  => "Burkina Faso",
            '28'  => "Burundi",
            '29'  => "Cambodia",
            '30'  => "Cameroon",
            '31'  => "Canada",
            '32'  => "Cape Verde",
            '33'  => "Central African Republic",
            '34'  => "Chad",
            '35'  => "Chile",
            '36'  => "China",
            '37'  => "Colombi",
            '38'  => "Comoros",
            '39'  => "Congo (Brazzaville)",
            '40'  => "Congo",
            '41'  => "Costa Rica",
            '42'  => "Cote d'Ivoire",
            '43'  => "Croatia",
            '44'  => "Cuba",
            '45'  => "Cyprus",
            '46'  => "Czech Republic",
            '47'  => "Denmark",
            '48'  => "Djibouti",
            '49'  => "Dominica",
            '50'  => "Dominican Republic",
            '51'  => "East Timor (Timor Timur)",
            '52'  => "Ecuador",
            '53'  => "Egypt",
            '54'  => "El Salvador",
            '55'  => "Equatorial Guinea",
            '56'  => "Eritrea",
            '57'  => "Estonia",
            '58'  => "Ethiopia",
            '59'  => "Fiji",
            '60'  => "Finland",
            '61'  => "France",
            '62'  => "Gabon",
            '63'  => "Gambia, The",
            '64'  => "Georgia",
            '65'  => "Germany",
            '66'  => "Ghana",
            '67'  => "Greece",
            '68'  => "Grenada",
            '69'  => "Guatemala",
            '70'  => "Guinea",
            '71'  => "Guinea-Bissau",
            '72'  => "Guyana",
            '73'  => "Haiti",
            '74'  => "Honduras",
            '75'  => "Hungary",
            '76'  => "Iceland",
            '77'  => "India",
            '78'  => "Indonesia",
            '79'  => "Iran",
            '80'  => "Iraq",
            '81'  => "Ireland",
            '82'  => "Israel",
            '83'  => "Italy",
            '84'  => "Jamaica",
            '85'  => "Japan",
            '86'  => "Jordan",
            '87'  => "Kazakhstan",
            '88'  => "Kenya",
            '89'  => "Kiribati",
            '90'  => "Korea, North",
            '91'  => "Korea, South",
            '92'  => "Kuwait",
            '93'  => "Kyrgyzstan",
            '94'  => "Laos",
            '95'  => "Latvia",
            '96'  => "Lebanon",
            '97'  => "Lesotho",
            '98'  => "Liberia",
            '99'  => "Libya",
            '100' => "Liechtenstein",
            '101' => "Lithuania",
            '102' => "Luxembourg",
            '103' => "Macedonia",
            '104' => "Madagascar",
            '105' => "Malawi",
            '106' => "Malaysia",
            '107' => "Maldives",
            '108' => "Mali",
            '109' => "Malta",
            '110' => "Marshall Islands",
            '111' => "Mauritania",
            '112' => "Mauritius",
            '113' => "Mexico",
            '114' => "Micronesia",
            '115' => "Moldova",
            '116' => "Monaco",
            '117' => "Mongolia",
            '118' => "Morocco",
            '119' => "Mozambique",
            '120' => "Myanmar",
            '121' => "Namibia",
            '122' => "Nauru",
            '123' => "Nepa",
            '124' => "Netherlands",
            '125' => "New Zealand",
            '126' => "Nicaragua",
            '127' => "Niger",
            '128' => "Nigeria",
            '129' => "Norway",
            '130' => "Oman",
            '131' => "Pakistan",
            '132' => "Palau",
            '133' => "Panama",
            '134' => "Papua New Guinea",
            '135' => "Paraguay",
            '136' => "Peru",
            '137' => "Philippines",
            '138' => "Poland",
            '139' => "Portugal",
            '140' => "Qatar",
            '141' => "Romania",
            '142' => "Russia",
            '143' => "Rwanda",
            '144' => "Saint Kitts and Nevis",
            '145' => "Saint Lucia",
            '146' => "Saint Vincent",
            '147' => "Samoa",
            '148' => "San Marino",
            '149' => "Sao Tome and Principe",
            '150' => "Saudi Arabia",
            '151' => "Senegal",
            '152' => "Serbia and Montenegro",
            '153' => "Seychelles",
            '154' => "Sierra Leone",
            '155' => "Singapore",
            '156' => "Slovakia",
            '157' => "Slovenia",
            '158' => "Solomon Islands",
            '159' => "Somalia",
            '160' => "South Africa",
            '161' => "Spain",
            '162' => "Sri Lanka",
            '163' => "Sudan",
            '164' => "Suriname",
            '165' => "Swaziland",
            '166' => "Sweden",
            '167' => "Switzerland",
            '168' => "Syria",
            '169' => "Taiwan",
            '170' => "Tajikistan",
            '171' => "Tanzania",
            '172' => "Thailand",
            '173' => "Togo",
            '174' => "Tonga",
            '175' => "Trinidad and Tobago",
            '176' => "Tunisia",
            '177' => "Turkey",
            '178' => "Turkmenistan",
            '179' => "Tuvalu",
            '180' => "Uganda",
            '181' => "Ukraine",
            '182' => "United Arab Emirates",
            '183' => "United Kingdom",
            '184' => "United States",
            '185' => "Uruguay",
            '186' => "Uzbekistan",
            '187' => "Vanuatu",
            '188' => "Vatican City",
            '189' => "Venezuela",
            '190' => "Vietnam",
            '191' => "Yemen",
            '192' => "Zambia",
            '193' => "Zimbabwe"
        ];

        return is_null($id) ? $country_list : array_get($country_list, $id);
    }

    public static function state($id = null)
    {
        $states = [
            'AL' => "Alabama",
            'AK' => "Alaska",
            'AZ' => "Arizona",
            'AR' => "Arkansas",
            'CA' => "California",
            'CO' => "Colorado",
            'CT' => "Connecticut",
            'DE' => "Delaware",
            'DC' => "District Of Columbia",
            'FL' => "Florida",
            'GA' => "Georgia",
            'HI' => "Hawaii",
            'ID' => "Idaho",
            'IL' => "Illinois",
            'IN' => "Indiana",
            'IA' => "Iowa",
            'KS' => "Kansas",
            'KY' => "Kentucky",
            'LA' => "Louisiana",
            'ME' => "Maine",
            'MD' => "Maryland",
            'MA' => "Massachusetts",
            'MI' => "Michigan",
            'MN' => "Minnesota",
            'MS' => "Mississippi",
            'MO' => "Missouri",
            'MT' => "Montana",
            'NE' => "Nebraska",
            'NV' => "Nevada",
            'NH' => "New Hampshire",
            'NJ' => "New Jersey",
            'NM' => "New Mexico",
            'NY' => "New York",
            'NC' => "North Carolina",
            'ND' => "North Dakota",
            'OH' => "Ohio",
            'OK' => "Oklahoma",
            'OR' => "Oregon",
            'PA' => "Pennsylvania",
            'RI' => "Rhode Island",
            'SC' => "South Carolina",
            'SD' => "South Dakota",
            'TN' => "Tennessee",
            'TX' => "Texas",
            'UT' => "Utah",
            'VT' => "Vermont",
            'VA' => "Virginia",
            'WA' => "Washington",
            'WV' => "West Virginia",
            'WI' => "Wisconsin",
            'WY' => "Wyoming"
        ];

        return is_null($id) ? $states : array_get($states, $id, $id);
    }
}
