<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 4.9.16
 * Time: 12.25
 */

namespace Talaka\CarrotQuestBundle\Service;


use Monolog\Logger;
use Veksa\Carrot\Api;

/**
 * Class ApiWrapper
 * @package Talaka\CarrotQuestBundle\Service
 * 
 * @method setProps($id, $props, $isSystem = true)
 * @method trackEvent($id, $eventName, $params = [], $isSystem = true)
 */
class ApiWrapper
{

    /**
     * @var Api
     */
    protected $api;

    /**
     * @var Logger
     */
    protected $logger;

    public function __construct($api)
    {
        $this->api = $api;
    }


    public function __call($name, $arguments)
    {

        if (method_exists($this->api, $name))   {

            $this->logger->log(Logger::DEBUG, "CarrotQuest call `$name` with params " . json_encode($arguments) );

            $ret = call_user_func_array([$this->api, $name], $arguments);

            $response = $this->api->getLastResponse();
            
            $this->logger->log(Logger::DEBUG, 'CarrotQuest response: ' . json_encode($response));

            return $ret;

        }
        else    {
            throw new \RuntimeException("Unknown method `$name`");
        }
    }

    /**
     * @param mixed $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    public function getLastResponse()   {
        return $this->api->getLastResponse();
    }



}