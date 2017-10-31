<?php
/**
 * @copyright since 9:49 28/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace Fmnii\Controller;

/**
 * Fmnii Controller Common
 *
 * # Status Code
 * Value | Meaning (`info`rmation)
 * --- | ---
 * 200 | OK
 * 404 | Not Found
 * @package Fmnii
 */
trait Common
{
    /**
     * @var int OK
     */
    protected static $scOK = 200;

    /**
     * @var int Not Found
     */
    protected static $scNotFound = 404;

    /**
     * Template for message returned
     * for **Fmnii**
     * @param int $statusCode
     * @param null|string $statusMessage
     * @param null|array $body
     * @return array
     * ->status Status code
     *
     * ->info Status message *optional*
     *
     * ->... Message body *optional*
     * @throws \Exception
     */
    protected static function retTemp($statusCode = 200, $statusMessage = null, $body = null)
    {
        $ret = [];

        // Status code
        if (in_array($statusCode, [self::$scOK, self::$scNotFound])) {
            $ret['status'] = $statusCode;
        } else {
            throw new \Exception('Status code is not in range');
        }

        // Status message
        if (is_string($statusMessage)) {
            $ret['info'] = $statusMessage;
        }

        /**
         * Message body set
         */
        if (is_array($body) || is_string($body)) {
            $ret['body'] = $body;
        } elseif ($body !== null) {
            throw new \Exception('Message body is not in type between array and string');
        }

        return $ret;
    }
}
