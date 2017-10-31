<?php
/**
 * @copyright since 9:51 28/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace Fmnii\Controller;

/**
 * Fmnii Controller Convention
 *
 * # Status Code
 * Value | Meaning (`info`rmation)
 * --- | ---
 * 1 | Succeeded
 * 0 | Failed
 * @package Fmnii\Controller
 */
trait Convention
{
    /**
     * @var int Succeeded
     */
    protected static $scSucceeded = 1;

    /**
     * @var int Failed
     */
    protected static $scFailed = 0;

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
    protected static function retTemp($statusCode = 1, $statusMessage = null, $body = null)
    {
        $ret = [];

        // Status code
        if (in_array($statusCode, [self::$scSucceeded, self::$scFailed])) {
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
        if (is_array($body)) {
            // Check if `status` or `info` is in `body` or not
            $statusKeyWithinBody = [];

            foreach (['status', 'info'] as &$key2bChecked) {
                if (array_key_exists($key2bChecked, $body)) {
                    $statusKeyWithinBody[] = $key2bChecked;
                }
            }

            if ($statusKeyWithinBody) {
                $eDesc = 'Message body with key ' . implode(' and ', $statusKeyWithinBody);
                throw new \Exception($eDesc);
            } else {
                $ret = array_merge($ret, $body);
            }
        } else {
            throw new \Exception('Message body is not an array');
        }

        return $ret;
    }
}
