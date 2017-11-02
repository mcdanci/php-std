<?php
/**
 * @copyright since 15:37 2/11/2017
 * @author <mcdanci@users.noreply.github.com>
 * @deprecated
 */
$mad = [
    'common' => [
        'name_first' => 'First Name',
        'name_last' => 'Last Name',
        'gender' => 'Gender',
        'email' => 'Email',
        'tel' => 'Telephone',
        'tel_cell' => 'Cell Phone',
        'company' => 'Company Name',
        'street' => 'Street',
        'city' => 'City',
        'state' => 'State (Required for U.S. and Canada Only)',
        'zip' => 'Zip Code',
        'iso3166' => 'Country',
        'website' => 'Company Website',
        'cat' => 'Category',
    ],
    'exhibitor' => [
        'c_opf' => 'Country(ies) with own production facility',
        'mpt' => 'Major Product Type(s)',
        'npe' => 'What specific NEW product(s) are you going to exhibit in S-SHOW',
        'mc' => 'Major Customer(s)',
        'tse' => 'What other trade shows do you exhibit with (if any)',
    ],
    'visitor' => [
        'job_function' => 'Job Function',
        'brand' => 'Brand',
        'f_man' => 'Footwear Manufacturer',
    ],
];

return array_merge($mad['common'], $mad['exhibitor'], $mad['visitor']);
