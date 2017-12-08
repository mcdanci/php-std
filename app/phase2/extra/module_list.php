<?php
/**
 * @copyright since 9:47 8/12/2017
 * @author <mc@dancis.info>
 */

const
MEMBER_ROLE_TYPE_EXHIBITOR = 1,
MEMBER_ROLE_TYPE_VISITOR = 2,
MEMBER_ROLE_TYPE_ADMIN = 3;

return [
    'signing' => [MEMBER_ROLE_TYPE_EXHIBITOR, MEMBER_ROLE_TYPE_VISITOR],
    'main' => [MEMBER_ROLE_TYPE_EXHIBITOR, MEMBER_ROLE_TYPE_VISITOR],
    'audit' => [MEMBER_ROLE_TYPE_ADMIN],
    'booth_selection' => [MEMBER_ROLE_TYPE_EXHIBITOR],
    'order' => [MEMBER_ROLE_TYPE_EXHIBITOR, MEMBER_ROLE_TYPE_VISITOR, MEMBER_ROLE_TYPE_ADMIN],
    'profile' => [MEMBER_ROLE_TYPE_EXHIBITOR, MEMBER_ROLE_TYPE_VISITOR, MEMBER_ROLE_TYPE_ADMIN],
    'help' => [MEMBER_ROLE_TYPE_EXHIBITOR, MEMBER_ROLE_TYPE_VISITOR, MEMBER_ROLE_TYPE_ADMIN],
];