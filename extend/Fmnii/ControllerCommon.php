<?php
/**
 * @copyright since 15:30 27/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace Fmnii;

/**
 * Fmnii Controller Common
 * @package Fmnii
 */
trait ControllerCommon
{
    /**
     * Fmnii return template
     * @param int $statusCode
     * @param null $statusMessage
     * @param null $body
     * @return array
     */
    protected static function fmniiTemplate($statusCode = 200, $statusMessage = null, $body = null)
    {
        $return = ['status' => $statusCode];
        $templateFmnii = [
            'info' => $statusMessage,
            'body' => $body,
        ];

        foreach ($templateFmnii as $k => &$v) {
            if ($v != null) {
                $return[$k] = $v;
            }
        }

        return $return;
    }
}
