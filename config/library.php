<?php

return [

    /*
     * Array image Extension
     */
    'image' => [
        'extension' => ['png', 'jpg'],
        'type' => 'image'
    ],

    /*
     * Array video Extension
     */
    'video' => [
        'extension' => ['mp4'],
        'type' => 'video'
    ],

    /*
     * Other file Extension
     */
    'other' => [
        'extension' => ['pdf', 'zip', 'doc', 'xlsx'],
        'type' => [
            'pdf' => 'Pdf',
            'zip' => 'Zip',
            'doc' => 'Document',
            'xlsx' => 'Spreadsheet'
        ]
    ]
];
