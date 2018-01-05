<?php
/**
 * Class JSON
 * @copyright since 14:39 5/1/2018
 * @author <mc@dancis.info>
 * @todo stdClass
 */
class JSON
{
    private $object;

    /**
     * @param $json
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     * @todo
     */
    public static function json_decode($json, $assoc = false, $depth = 512, $options = 0)
    {
    }

    /**
     * JSON constructor.
     * @param $data
     * @todo
     */
    public function __construct($data)
    {
        $this->object = $data;
    }

    /**
     * @param int $options
     * @param int $depth
     * @return string
     * @todo false to exception
     */
    public function encode(int $options = 0, int $depth = 512)
    {
        return json_encode($this->object, $options, $depth);
    }
}
