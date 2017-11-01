<?php
/**
 * @copyright since 10:15 26/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */

const
USERNAME = 'username',
PASSWORD = 'password';

return [
    'host' => 'smtp.exmail.qq.com',
    'port' => 465,
    'mailer' => [
        'web' => [
            USERNAME => 'web@fmnii.com',
            PASSWORD => '@Fmnii789',
        ],
        'admin' => [
            USERNAME => 'admin@sshow-online.com',
            PASSWORD => 'USA20#17*10&25xc1',
        ],
        'info' => [
            USERNAME => 'info@sshow-online.com',
            PASSWORD => 'UN20#17*oct25e&1',
        ]
    ],

    // TODO: for dev
    'username' => 'web@fmnii.com',
    'password' => '@Fmnii789',

    'recipient' => [ // `to`, `cc` and `bcc` could be set below
        'to' => [
            //'admin@sshow-online.com', // TODO: for deployment
            '15812890021@qq.com', // TODO: for dev
        ],
        // TODO: for dev
        //'bcc' => [
        //    '15812890021@qq.com',
        //],
    ],
];
