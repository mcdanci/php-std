<?php
/**
 * @copyright since 11:37 20/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
const TEMPLATE_DISPATCH = APP_PATH . 'api' . DS . 'view' . DS . 'Registration' . DS . 'dispatch_jump.tpl';

return [
    // app status: `status-dev-intranet`, `status-dev-internet` or `status-prod`
    // TODO: for dev, checking availability of `status-dev-intranet`
    'app_status' => 'status-dev-internet',

    //'view_suffix' => 'tpl', // TODO

    'default_return_type' => 'json',
    'dispatch_success_tmpl' => TEMPLATE_DISPATCH,
    'dispatch_error_tmpl' => TEMPLATE_DISPATCH,
];
