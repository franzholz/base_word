<?php

########################################################################
# Extension Manager/Repository config file for ext "base_word".
########################################################################

$EM_CONF[$_EXTKEY] = [
    'title'            => 'PHP Word Library',
    'description'      => 'This provides the PHPWord library from phpOffice.',
    'category'         => 'misc',
    'version'          => '0.0.2',
    'state'            => 'stable',
    'clearcacheonload' => 1,
    'author'           => 'PHPWord developers, Franz Holzinger',
    'author_email'     => 'franz@ttproducts.de',
    'author_company'   => 'jambage.com',
    'constraints'      => [
        'depends'   => [
            'php'   => '7.3.0-8.1.99',
            'typo3' => '10.4.0-11.5.99',
        ],
        'conflicts' => [
        ],
        'suggests'  => [
        ],
    ],
];
