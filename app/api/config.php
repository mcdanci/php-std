<?php
/**
 * @copyright since 11:37 20/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
const TEMPLATE_DISPATCH = APP_PATH . 'api' . DS . 'view' . DS . 'Registration' . DS . 'dispatch_jump.tpl';

return [
    // `dev-intranet`, `dev-internet` // TODO: checking availability
    'app_status' => 'dev-internet', // TODO: for dev

    'default_return_type' => 'json',
    'dispatch_success_tmpl'  => TEMPLATE_DISPATCH,
    'dispatch_error_tmpl'    => TEMPLATE_DISPATCH,
];
