<?php
/**
 * @copyright since 14:39 5/1/2018
 * @author <mc@dancis.info>
 */
namespace McDanci\std;

/**
 * JSON
 * @package McDanci\std
 * @todo stdClass
 */
class JSON
{
    //region Constant

    /**
     * @var int Option
     */
    const
        BIGINT_AS_STRING = JSON_BIGINT_AS_STRING,
        OBJECT_AS_ARRAY = JSON_OBJECT_AS_ARRAY;

    /**
     * @var int Option
     */
    const
        HEX_TAG = JSON_HEX_TAG,
        HEX_AMP = JSON_HEX_AMP,
        HEX_APOS = JSON_HEX_APOS,
        HEX_QUOT = JSON_HEX_QUOT,
        FORCE_OBJECT = JSON_FORCE_OBJECT,
        NUMERIC_CHECK = JSON_NUMERIC_CHECK,
        PRETTY_PRINT = JSON_PRETTY_PRINT,
        UNESCAPED_SLASHES = JSON_UNESCAPED_SLASHES,
        UNESCAPED_UNICODE = JSON_UNESCAPED_UNICODE,
        PARTIAL_OUTPUT_ON_ERROR = JSON_PARTIAL_OUTPUT_ON_ERROR,
        PRESERVE_ZERO_FRACTION = JSON_PRESERVE_ZERO_FRACTION;

    ///**
    // * @var int Option for PHP 7.1
    // */
    //const UNESCAPED_LINE_TERMINATORS = JSON_UNESCAPED_LINE_TERMINATORS;

    /**
     * @var int Error
     */
    const
        ERROR_NONE = JSON_ERROR_NONE,
        ERROR_DEPTH = JSON_ERROR_DEPTH,
        ERROR_STATE_MISMATCH = JSON_ERROR_STATE_MISMATCH,
        ERROR_CTRL_CHAR = JSON_ERROR_CTRL_CHAR,
        ERROR_SYNTAX = JSON_ERROR_SYNTAX,
        ERROR_UTF8 = JSON_ERROR_UTF8,
        ERROR_RECURSION = JSON_ERROR_RECURSION,
        ERROR_INF_OR_NAN = JSON_ERROR_INF_OR_NAN,
        ERROR_UNSUPPORTED_TYPE = JSON_ERROR_UNSUPPORTED_TYPE;

    ///**
    // * @var int Error for PHP 7
    // */
    //const
    //    ERROR_INVALID_PROPERTY_NAME = JSON_ERROR_INVALID_PROPERTY_NAME,
    //    ERROR_UTF16 = JSON_ERROR_UTF16;

    //endregion

    //region Static method

    /**
     * @param string $json
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     * @return mixed
     */
    public static function decode($json, $assoc = false, $depth = 512, $options = 0)
    {
        $result = json_decode($json, $assoc, $depth, $options);

        if ($result === null && trim($json) !== 'null') {
            throw new \Exception('Cannot be decoded or is deeper than the recursion limit');
        }

        return $result;
    }

    /**
     * @param mixed $value Could not be resource
     * @param int $options
     * @param int $depth
     * @return string
     */
    public static function encode($value, $options = 0, $depth = 512)
    {
        if ($depth < 1) {
            throw new \Exception;
        } else {
            $result = json_encode($value, $options, $depth);

            if ($value !== false && $result === false) {
                throw new \Exception;
            } else {
                return $result;
            }
        }
    }

    public static function getErrorLastMsg()
    {
        $result = json_last_error_msg();

        if ($result === false) {
            throw new \RuntimeException;
        } else {
            return $result;
        }
    }

    public static function getErrorLast()
    {
        return json_last_error();
    }

    //endregion
}
