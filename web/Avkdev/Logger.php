<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 21.08.14
 * Time: 9:26
 */

namespace Avkdev;


class Logger
{
    /**
     * @var Logger
     */
    private static $instance;

    /**
     * @var array
     */
    private $log = array();

    /**
     * @var string
     */
    private $delimiter = '';

    /**
     * Constructor
     */
    private function __construct()
    {
        $this->delimiter = php_sapi_name() === 'cli' ? "\n" : "<br/>\n";
    }

    /**
     * @return Logger
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * @param $message
     * @return $this
     */
    public function add($message)
    {
        $this->log[] = $message;
        //echo $message . $this->delimiter;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return implode($this->delimiter, $this->log);
    }
} 