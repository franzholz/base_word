<?php

########################################################################
# Extension Manager/Repository config file for ext "base_word".
########################################################################

$EM_CONF[$_EXTKEY] = [
    'title'            => 'PHP Word Library',
    'description'      => 'This provides the PHPWord library from phpOffice.',
    'category'         => 'misc',
    'version'          => '1.0.0',
    'state'            => 'stable',
    'clearcacheonload' => 1,
    'author'           => 'PHPWord developers, Franz Holzinger',
    'author_email'     => 'franz@ttproducts.de',
    'author_company'   => 'jambage.com',
    'constraints'      => [
        'depends'   => [
            'typo3' => '10.4.0-12.4.99',
        ],
        'conflicts' => [
        ],
        'suggests'  => [
            'escaper' => ''
        ],
    ],
];
