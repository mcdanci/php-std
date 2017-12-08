<?php
/**
 * @copyright since 11:37 20/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
const TEMPLATE_DISPATCH = APP_PATH . 'api' . DS . 'view' . DS . 'Registration' . DS . 'dispatch_jump.tpl';

return [
    // app status: `status-dev-intranet`, `status-dev-internet` or `status-prod`
    // TODO: for dev, checking availability of `status-dev-intranet`
    APP_STATUS => 'status-dev-internet',

    //'view_suffix' => 'tpl', // TODO

    RETURN_TYPE_DEFAULT => 'json',
    TEMPLATE_SUCCESS => TEMPLATE_DISPATCH,
    TEMPLATE_ERROR => TEMPLATE_DISPATCH,
];
