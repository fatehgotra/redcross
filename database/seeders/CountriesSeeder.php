<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('countries')->delete();
        
        DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'iso' => 'AF',
                'country' => 'Afghanistan',
            ),
            1 => 
            array (
                'id' => 2,
                'iso' => 'AL',
                'country' => 'Albania',
            ),
            2 => 
            array (
                'id' => 3,
                'iso' => 'DZ',
                'country' => 'Algeria',
            ),
            3 => 
            array (
                'id' => 4,
                'iso' => 'AS',
                'country' => 'American Samoa',
            ),
            4 => 
            array (
                'id' => 5,
                'iso' => 'AD',
                'country' => 'Andorra',
            ),
            5 => 
            array (
                'id' => 6,
                'iso' => 'AO',
                'country' => 'Angola',
            ),
            6 => 
            array (
                'id' => 7,
                'iso' => 'AI',
                'country' => 'Anguilla',
            ),
            7 => 
            array (
                'id' => 8,
                'iso' => 'AQ',
                'country' => 'Antarctica',
            ),
            8 => 
            array (
                'id' => 9,
                'iso' => 'AG',
                'country' => 'Antigua and Barbuda',
            ),
            9 => 
            array (
                'id' => 10,
                'iso' => 'AR',
                'country' => 'Argentina',
            ),
            10 => 
            array (
                'id' => 11,
                'iso' => 'AM',
                'country' => 'Armenia',
            ),
            11 => 
            array (
                'id' => 12,
                'iso' => 'AW',
                'country' => 'Aruba',
            ),
            12 => 
            array (
                'id' => 13,
                'iso' => 'AU',
                'country' => 'Australia',
            ),
            13 => 
            array (
                'id' => 14,
                'iso' => 'AT',
                'country' => 'Austria',
            ),
            14 => 
            array (
                'id' => 15,
                'iso' => 'AZ',
                'country' => 'Azerbaijan',
            ),
            15 => 
            array (
                'id' => 16,
                'iso' => 'BS',
                'country' => 'Bahamas',
            ),
            16 => 
            array (
                'id' => 17,
                'iso' => 'BH',
                'country' => 'Bahrain',
            ),
            17 => 
            array (
                'id' => 18,
                'iso' => 'BD',
                'country' => 'Bangladesh',
            ),
            18 => 
            array (
                'id' => 19,
                'iso' => 'BB',
                'country' => 'Barbados',
            ),
            19 => 
            array (
                'id' => 20,
                'iso' => 'BY',
                'country' => 'Belarus',
            ),
            20 => 
            array (
                'id' => 21,
                'iso' => 'BE',
                'country' => 'Belgium',
            ),
            21 => 
            array (
                'id' => 22,
                'iso' => 'BZ',
                'country' => 'Belize',
            ),
            22 => 
            array (
                'id' => 23,
                'iso' => 'BJ',
                'country' => 'Benin',
            ),
            23 => 
            array (
                'id' => 24,
                'iso' => 'BM',
                'country' => 'Bermuda',
            ),
            24 => 
            array (
                'id' => 25,
                'iso' => 'BT',
                'country' => 'Bhutan',
            ),
            25 => 
            array (
                'id' => 26,
                'iso' => 'BO',
                'country' => 'Bolivia',
            ),
            26 => 
            array (
                'id' => 27,
                'iso' => 'BA',
                'country' => 'Bosnia and Herzegovina',
            ),
            27 => 
            array (
                'id' => 28,
                'iso' => 'BW',
                'country' => 'Botswana',
            ),
            28 => 
            array (
                'id' => 29,
                'iso' => 'BV',
                'country' => 'Bouvet Island',
            ),
            29 => 
            array (
                'id' => 30,
                'iso' => 'BR',
                'country' => 'Brazil',
            ),
            30 => 
            array (
                'id' => 31,
                'iso' => 'IO',
                'country' => 'British Indian Ocean Territory',
            ),
            31 => 
            array (
                'id' => 32,
                'iso' => 'BN',
                'country' => 'Brunei Darussalam',
            ),
            32 => 
            array (
                'id' => 33,
                'iso' => 'BG',
                'country' => 'Bulgaria',
            ),
            33 => 
            array (
                'id' => 34,
                'iso' => 'BF',
                'country' => 'Burkina Faso',
            ),
            34 => 
            array (
                'id' => 35,
                'iso' => 'BI',
                'country' => 'Burundi',
            ),
            35 => 
            array (
                'id' => 36,
                'iso' => 'KH',
                'country' => 'Cambodia',
            ),
            36 => 
            array (
                'id' => 37,
                'iso' => 'CM',
                'country' => 'Cameroon',
            ),
            37 => 
            array (
                'id' => 38,
                'iso' => 'CA',
                'country' => 'Canada',
            ),
            38 => 
            array (
                'id' => 39,
                'iso' => 'CV',
                'country' => 'Cape Verde',
            ),
            39 => 
            array (
                'id' => 40,
                'iso' => 'KY',
                'country' => 'Cayman Islands',
            ),
            40 => 
            array (
                'id' => 41,
                'iso' => 'CF',
                'country' => 'Central African Republic',
            ),
            41 => 
            array (
                'id' => 42,
                'iso' => 'TD',
                'country' => 'Chad',
            ),
            42 => 
            array (
                'id' => 43,
                'iso' => 'CL',
                'country' => 'Chile',
            ),
            43 => 
            array (
                'id' => 44,
                'iso' => 'CN',
                'country' => 'China',
            ),
            44 => 
            array (
                'id' => 45,
                'iso' => 'CX',
                'country' => 'Christmas Island',
            ),
            45 => 
            array (
                'id' => 46,
                'iso' => 'CC',
            'country' => 'Cocos (Keeling) Islands',
            ),
            46 => 
            array (
                'id' => 47,
                'iso' => 'CO',
                'country' => 'Colombia',
            ),
            47 => 
            array (
                'id' => 48,
                'iso' => 'KM',
                'country' => 'Comoros',
            ),
            48 => 
            array (
                'id' => 49,
                'iso' => 'CG',
                'country' => 'Congo',
            ),
            49 => 
            array (
                'id' => 50,
                'iso' => 'CD',
                'country' => 'Congo, the Democratic Republic of the',
            ),
            50 => 
            array (
                'id' => 51,
                'iso' => 'CK',
                'country' => 'Cook Islands',
            ),
            51 => 
            array (
                'id' => 52,
                'iso' => 'CR',
                'country' => 'Costa Rica',
            ),
            52 => 
            array (
                'id' => 53,
                'iso' => 'CI',
                'country' => 'Cote D\'Ivoire',
            ),
            53 => 
            array (
                'id' => 54,
                'iso' => 'HR',
                'country' => 'Croatia',
            ),
            54 => 
            array (
                'id' => 55,
                'iso' => 'CU',
                'country' => 'Cuba',
            ),
            55 => 
            array (
                'id' => 56,
                'iso' => 'CY',
                'country' => 'Cyprus',
            ),
            56 => 
            array (
                'id' => 57,
                'iso' => 'CZ',
                'country' => 'Czech Republic',
            ),
            57 => 
            array (
                'id' => 58,
                'iso' => 'DK',
                'country' => 'Denmark',
            ),
            58 => 
            array (
                'id' => 59,
                'iso' => 'DJ',
                'country' => 'Djibouti',
            ),
            59 => 
            array (
                'id' => 60,
                'iso' => 'DM',
                'country' => 'Dominica',
            ),
            60 => 
            array (
                'id' => 61,
                'iso' => 'DO',
                'country' => 'Dominican Republic',
            ),
            61 => 
            array (
                'id' => 62,
                'iso' => 'EC',
                'country' => 'Ecuador',
            ),
            62 => 
            array (
                'id' => 63,
                'iso' => 'EG',
                'country' => 'Egypt',
            ),
            63 => 
            array (
                'id' => 64,
                'iso' => 'SV',
                'country' => 'El Salvador',
            ),
            64 => 
            array (
                'id' => 65,
                'iso' => 'GQ',
                'country' => 'Equatorial Guinea',
            ),
            65 => 
            array (
                'id' => 66,
                'iso' => 'ER',
                'country' => 'Eritrea',
            ),
            66 => 
            array (
                'id' => 67,
                'iso' => 'EE',
                'country' => 'Estonia',
            ),
            67 => 
            array (
                'id' => 68,
                'iso' => 'ET',
                'country' => 'Ethiopia',
            ),
            68 => 
            array (
                'id' => 69,
                'iso' => 'FK',
            'country' => 'Falkland Islands (Malvinas)',
            ),
            69 => 
            array (
                'id' => 70,
                'iso' => 'FO',
                'country' => 'Faroe Islands',
            ),
            70 => 
            array (
                'id' => 71,
                'iso' => 'FJ',
                'country' => 'Fiji',
            ),
            71 => 
            array (
                'id' => 72,
                'iso' => 'FI',
                'country' => 'Finland',
            ),
            72 => 
            array (
                'id' => 73,
                'iso' => 'FR',
                'country' => 'France',
            ),
            73 => 
            array (
                'id' => 74,
                'iso' => 'GF',
                'country' => 'French Guiana',
            ),
            74 => 
            array (
                'id' => 75,
                'iso' => 'PF',
                'country' => 'French Polynesia',
            ),
            75 => 
            array (
                'id' => 76,
                'iso' => 'TF',
                'country' => 'French Southern Territories',
            ),
            76 => 
            array (
                'id' => 77,
                'iso' => 'GA',
                'country' => 'Gabon',
            ),
            77 => 
            array (
                'id' => 78,
                'iso' => 'GM',
                'country' => 'Gambia',
            ),
            78 => 
            array (
                'id' => 79,
                'iso' => 'GE',
                'country' => 'Georgia',
            ),
            79 => 
            array (
                'id' => 80,
                'iso' => 'DE',
                'country' => 'Germany',
            ),
            80 => 
            array (
                'id' => 81,
                'iso' => 'GH',
                'country' => 'Ghana',
            ),
            81 => 
            array (
                'id' => 82,
                'iso' => 'GI',
                'country' => 'Gibraltar',
            ),
            82 => 
            array (
                'id' => 83,
                'iso' => 'GR',
                'country' => 'Greece',
            ),
            83 => 
            array (
                'id' => 84,
                'iso' => 'GL',
                'country' => 'Greenland',
            ),
            84 => 
            array (
                'id' => 85,
                'iso' => 'GD',
                'country' => 'Grenada',
            ),
            85 => 
            array (
                'id' => 86,
                'iso' => 'GP',
                'country' => 'Guadeloupe',
            ),
            86 => 
            array (
                'id' => 87,
                'iso' => 'GU',
                'country' => 'Guam',
            ),
            87 => 
            array (
                'id' => 88,
                'iso' => 'GT',
                'country' => 'Guatemala',
            ),
            88 => 
            array (
                'id' => 89,
                'iso' => 'GN',
                'country' => 'Guinea',
            ),
            89 => 
            array (
                'id' => 90,
                'iso' => 'GW',
                'country' => 'Guinea-Bissau',
            ),
            90 => 
            array (
                'id' => 91,
                'iso' => 'GY',
                'country' => 'Guyana',
            ),
            91 => 
            array (
                'id' => 92,
                'iso' => 'HT',
                'country' => 'Haiti',
            ),
            92 => 
            array (
                'id' => 93,
                'iso' => 'HM',
                'country' => 'Heard Island and Mcdonald Islands',
            ),
            93 => 
            array (
                'id' => 94,
                'iso' => 'VA',
            'country' => 'Holy See (Vatican City State)',
            ),
            94 => 
            array (
                'id' => 95,
                'iso' => 'HN',
                'country' => 'Honduras',
            ),
            95 => 
            array (
                'id' => 96,
                'iso' => 'HK',
                'country' => 'Hong Kong',
            ),
            96 => 
            array (
                'id' => 97,
                'iso' => 'HU',
                'country' => 'Hungary',
            ),
            97 => 
            array (
                'id' => 98,
                'iso' => 'IS',
                'country' => 'Iceland',
            ),
            98 => 
            array (
                'id' => 99,
                'iso' => 'IN',
                'country' => 'India',
            ),
            99 => 
            array (
                'id' => 100,
                'iso' => 'ID',
                'country' => 'Indonesia',
            ),
            100 => 
            array (
                'id' => 101,
                'iso' => 'IR',
                'country' => 'Iran, Islamic Republic of',
            ),
            101 => 
            array (
                'id' => 102,
                'iso' => 'IQ',
                'country' => 'Iraq',
            ),
            102 => 
            array (
                'id' => 103,
                'iso' => 'IE',
                'country' => 'Ireland',
            ),
            103 => 
            array (
                'id' => 104,
                'iso' => 'IL',
                'country' => 'Israel',
            ),
            104 => 
            array (
                'id' => 105,
                'iso' => 'IT',
                'country' => 'Italy',
            ),
            105 => 
            array (
                'id' => 106,
                'iso' => 'JM',
                'country' => 'Jamaica',
            ),
            106 => 
            array (
                'id' => 107,
                'iso' => 'JP',
                'country' => 'Japan',
            ),
            107 => 
            array (
                'id' => 108,
                'iso' => 'JO',
                'country' => 'Jordan',
            ),
            108 => 
            array (
                'id' => 109,
                'iso' => 'KZ',
                'country' => 'Kazakhstan',
            ),
            109 => 
            array (
                'id' => 110,
                'iso' => 'KE',
                'country' => 'Kenya',
            ),
            110 => 
            array (
                'id' => 111,
                'iso' => 'KI',
                'country' => 'Kiribati',
            ),
            111 => 
            array (
                'id' => 112,
                'iso' => 'KP',
                'country' => 'Korea, Democratic People\'s Republic of',
            ),
            112 => 
            array (
                'id' => 113,
                'iso' => 'KR',
                'country' => 'Korea, Republic of',
            ),
            113 => 
            array (
                'id' => 114,
                'iso' => 'KW',
                'country' => 'Kuwait',
            ),
            114 => 
            array (
                'id' => 115,
                'iso' => 'KG',
                'country' => 'Kyrgyzstan',
            ),
            115 => 
            array (
                'id' => 116,
                'iso' => 'LA',
                'country' => 'Lao People\'s Democratic Republic',
            ),
            116 => 
            array (
                'id' => 117,
                'iso' => 'LV',
                'country' => 'Latvia',
            ),
            117 => 
            array (
                'id' => 118,
                'iso' => 'LB',
                'country' => 'Lebanon',
            ),
            118 => 
            array (
                'id' => 119,
                'iso' => 'LS',
                'country' => 'Lesotho',
            ),
            119 => 
            array (
                'id' => 120,
                'iso' => 'LR',
                'country' => 'Liberia',
            ),
            120 => 
            array (
                'id' => 121,
                'iso' => 'LY',
                'country' => 'Libyan Arab Jamahiriya',
            ),
            121 => 
            array (
                'id' => 122,
                'iso' => 'LI',
                'country' => 'Liechtenstein',
            ),
            122 => 
            array (
                'id' => 123,
                'iso' => 'LT',
                'country' => 'Lithuania',
            ),
            123 => 
            array (
                'id' => 124,
                'iso' => 'LU',
                'country' => 'Luxembourg',
            ),
            124 => 
            array (
                'id' => 125,
                'iso' => 'MO',
                'country' => 'Macao',
            ),
            125 => 
            array (
                'id' => 126,
                'iso' => 'MK',
                'country' => 'Macedonia, the Former Yugoslav Republic of',
            ),
            126 => 
            array (
                'id' => 127,
                'iso' => 'MG',
                'country' => 'Madagascar',
            ),
            127 => 
            array (
                'id' => 128,
                'iso' => 'MW',
                'country' => 'Malawi',
            ),
            128 => 
            array (
                'id' => 129,
                'iso' => 'MY',
                'country' => 'Malaysia',
            ),
            129 => 
            array (
                'id' => 130,
                'iso' => 'MV',
                'country' => 'Maldives',
            ),
            130 => 
            array (
                'id' => 131,
                'iso' => 'ML',
                'country' => 'Mali',
            ),
            131 => 
            array (
                'id' => 132,
                'iso' => 'MT',
                'country' => 'Malta',
            ),
            132 => 
            array (
                'id' => 133,
                'iso' => 'MH',
                'country' => 'Marshall Islands',
            ),
            133 => 
            array (
                'id' => 134,
                'iso' => 'MQ',
                'country' => 'Martinique',
            ),
            134 => 
            array (
                'id' => 135,
                'iso' => 'MR',
                'country' => 'Mauritania',
            ),
            135 => 
            array (
                'id' => 136,
                'iso' => 'MU',
                'country' => 'Mauritius',
            ),
            136 => 
            array (
                'id' => 137,
                'iso' => 'YT',
                'country' => 'Mayotte',
            ),
            137 => 
            array (
                'id' => 138,
                'iso' => 'MX',
                'country' => 'Mexico',
            ),
            138 => 
            array (
                'id' => 139,
                'iso' => 'FM',
                'country' => 'Micronesia, Federated States of',
            ),
            139 => 
            array (
                'id' => 140,
                'iso' => 'MD',
                'country' => 'Moldova, Republic of',
            ),
            140 => 
            array (
                'id' => 141,
                'iso' => 'MC',
                'country' => 'Monaco',
            ),
            141 => 
            array (
                'id' => 142,
                'iso' => 'MN',
                'country' => 'Mongolia',
            ),
            142 => 
            array (
                'id' => 143,
                'iso' => 'MS',
                'country' => 'Montserrat',
            ),
            143 => 
            array (
                'id' => 144,
                'iso' => 'MA',
                'country' => 'Morocco',
            ),
            144 => 
            array (
                'id' => 145,
                'iso' => 'MZ',
                'country' => 'Mozambique',
            ),
            145 => 
            array (
                'id' => 146,
                'iso' => 'MM',
                'country' => 'Myanmar',
            ),
            146 => 
            array (
                'id' => 147,
                'iso' => 'NA',
                'country' => 'Namibia',
            ),
            147 => 
            array (
                'id' => 148,
                'iso' => 'NR',
                'country' => 'Nauru',
            ),
            148 => 
            array (
                'id' => 149,
                'iso' => 'NP',
                'country' => 'Nepal',
            ),
            149 => 
            array (
                'id' => 150,
                'iso' => 'NL',
                'country' => 'Netherlands',
            ),
            150 => 
            array (
                'id' => 151,
                'iso' => 'AN',
                'country' => 'Netherlands Antilles',
            ),
            151 => 
            array (
                'id' => 152,
                'iso' => 'NC',
                'country' => 'New Caledonia',
            ),
            152 => 
            array (
                'id' => 153,
                'iso' => 'NZ',
                'country' => 'New Zealand',
            ),
            153 => 
            array (
                'id' => 154,
                'iso' => 'NI',
                'country' => 'Nicaragua',
            ),
            154 => 
            array (
                'id' => 155,
                'iso' => 'NE',
                'country' => 'Niger',
            ),
            155 => 
            array (
                'id' => 156,
                'iso' => 'NG',
                'country' => 'Nigeria',
            ),
            156 => 
            array (
                'id' => 157,
                'iso' => 'NU',
                'country' => 'Niue',
            ),
            157 => 
            array (
                'id' => 158,
                'iso' => 'NF',
                'country' => 'Norfolk Island',
            ),
            158 => 
            array (
                'id' => 159,
                'iso' => 'MP',
                'country' => 'Northern Mariana Islands',
            ),
            159 => 
            array (
                'id' => 160,
                'iso' => 'NO',
                'country' => 'Norway',
            ),
            160 => 
            array (
                'id' => 161,
                'iso' => 'OM',
                'country' => 'Oman',
            ),
            161 => 
            array (
                'id' => 162,
                'iso' => 'PK',
                'country' => 'Pakistan',
            ),
            162 => 
            array (
                'id' => 163,
                'iso' => 'PW',
                'country' => 'Palau',
            ),
            163 => 
            array (
                'id' => 164,
                'iso' => 'PS',
                'country' => 'Palestinian Territory, Occupied',
            ),
            164 => 
            array (
                'id' => 165,
                'iso' => 'PA',
                'country' => 'Panama',
            ),
            165 => 
            array (
                'id' => 166,
                'iso' => 'PG',
                'country' => 'Papua New Guinea',
            ),
            166 => 
            array (
                'id' => 167,
                'iso' => 'PY',
                'country' => 'Paraguay',
            ),
            167 => 
            array (
                'id' => 168,
                'iso' => 'PE',
                'country' => 'Peru',
            ),
            168 => 
            array (
                'id' => 169,
                'iso' => 'PH',
                'country' => 'Philippines',
            ),
            169 => 
            array (
                'id' => 170,
                'iso' => 'PN',
                'country' => 'Pitcairn',
            ),
            170 => 
            array (
                'id' => 171,
                'iso' => 'PL',
                'country' => 'Poland',
            ),
            171 => 
            array (
                'id' => 172,
                'iso' => 'PT',
                'country' => 'Portugal',
            ),
            172 => 
            array (
                'id' => 173,
                'iso' => 'PR',
                'country' => 'Puerto Rico',
            ),
            173 => 
            array (
                'id' => 174,
                'iso' => 'QA',
                'country' => 'Qatar',
            ),
            174 => 
            array (
                'id' => 175,
                'iso' => 'RE',
                'country' => 'Reunion',
            ),
            175 => 
            array (
                'id' => 176,
                'iso' => 'RO',
                'country' => 'Romania',
            ),
            176 => 
            array (
                'id' => 177,
                'iso' => 'RU',
                'country' => 'Russian Federation',
            ),
            177 => 
            array (
                'id' => 178,
                'iso' => 'RW',
                'country' => 'Rwanda',
            ),
            178 => 
            array (
                'id' => 179,
                'iso' => 'SH',
                'country' => 'Saint Helena',
            ),
            179 => 
            array (
                'id' => 180,
                'iso' => 'KN',
                'country' => 'Saint Kitts and Nevis',
            ),
            180 => 
            array (
                'id' => 181,
                'iso' => 'LC',
                'country' => 'Saint Lucia',
            ),
            181 => 
            array (
                'id' => 182,
                'iso' => 'PM',
                'country' => 'Saint Pierre and Miquelon',
            ),
            182 => 
            array (
                'id' => 183,
                'iso' => 'VC',
                'country' => 'Saint Vincent and the Grenadines',
            ),
            183 => 
            array (
                'id' => 184,
                'iso' => 'WS',
                'country' => 'Samoa',
            ),
            184 => 
            array (
                'id' => 185,
                'iso' => 'SM',
                'country' => 'San Marino',
            ),
            185 => 
            array (
                'id' => 186,
                'iso' => 'ST',
                'country' => 'Sao Tome and Principe',
            ),
            186 => 
            array (
                'id' => 187,
                'iso' => 'SA',
                'country' => 'Saudi Arabia',
            ),
            187 => 
            array (
                'id' => 188,
                'iso' => 'SN',
                'country' => 'Senegal',
            ),
            188 => 
            array (
                'id' => 189,
                'iso' => 'CS',
                'country' => 'Serbia and Montenegro',
            ),
            189 => 
            array (
                'id' => 190,
                'iso' => 'SC',
                'country' => 'Seychelles',
            ),
            190 => 
            array (
                'id' => 191,
                'iso' => 'SL',
                'country' => 'Sierra Leone',
            ),
            191 => 
            array (
                'id' => 192,
                'iso' => 'SG',
                'country' => 'Singapore',
            ),
            192 => 
            array (
                'id' => 193,
                'iso' => 'SK',
                'country' => 'Slovakia',
            ),
            193 => 
            array (
                'id' => 194,
                'iso' => 'SI',
                'country' => 'Slovenia',
            ),
            194 => 
            array (
                'id' => 195,
                'iso' => 'SB',
                'country' => 'Solomon Islands',
            ),
            195 => 
            array (
                'id' => 196,
                'iso' => 'SO',
                'country' => 'Somalia',
            ),
            196 => 
            array (
                'id' => 197,
                'iso' => 'ZA',
                'country' => 'South Africa',
            ),
            197 => 
            array (
                'id' => 198,
                'iso' => 'GS',
                'country' => 'South Georgia and the South Sandwich Islands',
            ),
            198 => 
            array (
                'id' => 199,
                'iso' => 'ES',
                'country' => 'Spain',
            ),
            199 => 
            array (
                'id' => 200,
                'iso' => 'LK',
                'country' => 'Sri Lanka',
            ),
            200 => 
            array (
                'id' => 201,
                'iso' => 'SD',
                'country' => 'Sudan',
            ),
            201 => 
            array (
                'id' => 202,
                'iso' => 'SR',
                'country' => 'Suriname',
            ),
            202 => 
            array (
                'id' => 203,
                'iso' => 'SJ',
                'country' => 'Svalbard and Jan Mayen',
            ),
            203 => 
            array (
                'id' => 204,
                'iso' => 'SZ',
                'country' => 'Swaziland',
            ),
            204 => 
            array (
                'id' => 205,
                'iso' => 'SE',
                'country' => 'Sweden',
            ),
            205 => 
            array (
                'id' => 206,
                'iso' => 'CH',
                'country' => 'Switzerland',
            ),
            206 => 
            array (
                'id' => 207,
                'iso' => 'SY',
                'country' => 'Syrian Arab Republic',
            ),
            207 => 
            array (
                'id' => 208,
                'iso' => 'TW',
                'country' => 'Taiwan, Province of China',
            ),
            208 => 
            array (
                'id' => 209,
                'iso' => 'TJ',
                'country' => 'Tajikistan',
            ),
            209 => 
            array (
                'id' => 210,
                'iso' => 'TZ',
                'country' => 'Tanzania, United Republic of',
            ),
            210 => 
            array (
                'id' => 211,
                'iso' => 'TH',
                'country' => 'Thailand',
            ),
            211 => 
            array (
                'id' => 212,
                'iso' => 'TL',
                'country' => 'Timor-Leste',
            ),
            212 => 
            array (
                'id' => 213,
                'iso' => 'TG',
                'country' => 'Togo',
            ),
            213 => 
            array (
                'id' => 214,
                'iso' => 'TK',
                'country' => 'Tokelau',
            ),
            214 => 
            array (
                'id' => 215,
                'iso' => 'TO',
                'country' => 'Tonga',
            ),
            215 => 
            array (
                'id' => 216,
                'iso' => 'TT',
                'country' => 'Trinidad and Tobago',
            ),
            216 => 
            array (
                'id' => 217,
                'iso' => 'TN',
                'country' => 'Tunisia',
            ),
            217 => 
            array (
                'id' => 218,
                'iso' => 'TR',
                'country' => 'Turkey',
            ),
            218 => 
            array (
                'id' => 219,
                'iso' => 'TM',
                'country' => 'Turkmenistan',
            ),
            219 => 
            array (
                'id' => 220,
                'iso' => 'TC',
                'country' => 'Turks and Caicos Islands',
            ),
            220 => 
            array (
                'id' => 221,
                'iso' => 'TV',
                'country' => 'Tuvalu',
            ),
            221 => 
            array (
                'id' => 222,
                'iso' => 'UG',
                'country' => 'Uganda',
            ),
            222 => 
            array (
                'id' => 223,
                'iso' => 'UA',
                'country' => 'Ukraine',
            ),
            223 => 
            array (
                'id' => 224,
                'iso' => 'AE',
                'country' => 'United Arab Emirates',
            ),
            224 => 
            array (
                'id' => 225,
                'iso' => 'GB',
                'country' => 'United Kingdom',
            ),
            225 => 
            array (
                'id' => 226,
                'iso' => 'US',
                'country' => 'United States',
            ),
            226 => 
            array (
                'id' => 227,
                'iso' => 'UM',
                'country' => 'United States Minor Outlying Islands',
            ),
            227 => 
            array (
                'id' => 228,
                'iso' => 'UY',
                'country' => 'Uruguay',
            ),
            228 => 
            array (
                'id' => 229,
                'iso' => 'UZ',
                'country' => 'Uzbekistan',
            ),
            229 => 
            array (
                'id' => 230,
                'iso' => 'VU',
                'country' => 'Vanuatu',
            ),
            230 => 
            array (
                'id' => 231,
                'iso' => 'VE',
                'country' => 'Venezuela',
            ),
            231 => 
            array (
                'id' => 232,
                'iso' => 'VN',
                'country' => 'Viet Nam',
            ),
            232 => 
            array (
                'id' => 233,
                'iso' => 'VG',
                'country' => 'Virgin Islands, British',
            ),
            233 => 
            array (
                'id' => 234,
                'iso' => 'VI',
                'country' => 'Virgin Islands, U.s.',
            ),
            234 => 
            array (
                'id' => 235,
                'iso' => 'WF',
                'country' => 'Wallis and Futuna',
            ),
            235 => 
            array (
                'id' => 236,
                'iso' => 'EH',
                'country' => 'Western Sahara',
            ),
            236 => 
            array (
                'id' => 237,
                'iso' => 'YE',
                'country' => 'Yemen',
            ),
            237 => 
            array (
                'id' => 238,
                'iso' => 'ZM',
                'country' => 'Zambia',
            ),
            238 => 
            array (
                'id' => 239,
                'iso' => 'ZW',
                'country' => 'Zimbabwe',
            ),
        ));
        
        
    }
}
