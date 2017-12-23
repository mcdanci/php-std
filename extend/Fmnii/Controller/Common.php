<?php
/**
 * @copyright since 9:49 28/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace Fmnii\Controller;

use McDanci\ThinkPHP\Config;
use think\Controller;
use think\Response;

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
    //region HTTP description

    protected static $httpOk = 'OK';
    protected static $httpForbidden = 'Forbidden';
    protected static $httpNotFound = 'Not Found';
    protected static $httpErrorServerInternal = 'Internal Server Error';

    /**
     * @var int OK
     */
    protected static $scOK = 200;

    /**
     * @var int Forbidden
     */
    protected static $scForbidden = 403;

    /**
     * @var int Not Found
     */
    protected static $scNotFound = 404;

    /**
     * @var int Internal Server Error
     */
    protected static $scErrorServerInternal = 500;

    //endregion

    //region Main

    /**
     * Get status code list.
     * Status codes should be registered within this method.
     * @return array
     */
    protected static function listStatusCode()
    {
        return [
            self::$scOK,
            self::$scForbidden,
            self::$scNotFound,
        ];
    }

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
        $retData = [];

        // Status code
        if (in_array($statusCode, self::listStatusCode())) {
            $retData['status'] = $statusCode;
        } else {
            throw new \Exception('Status code is not in range');
        }

        // Status message
        if (is_string($statusMessage)) {
            $retData['info'] = $statusMessage;
        }

        /**
         * Message body set
         */
        if (is_array($body) || is_string($body)) {
            $retData['body'] = $body;
        } elseif ($body !== null) {
            throw new \Exception('Message body is not in type between array and string');
        }

        // TODO
        //if (true) {
        //    $headerDesc = 'HTTP/1.1 ' . $statusCode . ' ';
        //
        //    switch ($statusCode) {
        //        case self::$scOK:
        //            $headerDesc .= self::$httpOk;
        //            break;
        //        case self::$scForbidden:
        //            $headerDesc .= self::$httpForbidden;
        //            break;
        //        case self::$scNotFound:
        //            $headerDesc .= self::$httpNotFound;
        //            break;
        //        case self::$scErrorServerInternal:
        //            $headerDesc .= self::$httpErrorServerInternal;
        //            break;
        //    }
        //
        //    header($headerDesc);
        //
        //    dump($headerDesc);
        //}
        //http_response_code(404);
        //header('HTTP/1.1 301 Moved Permanently');

        return Response::create($retData, Config::get(RETURN_TYPE_DEFAULT))
            //->code($statusCode) // TODO
            ;
    }

    //endregion
}
