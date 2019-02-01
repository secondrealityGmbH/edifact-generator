<?php
/**
 * Created by PhpStorm.
 * User: fstuhec
 * Date: 09.10.2017
 * Time: 16:19
 */

namespace EDI\Generator;


class Iftsta extends Message
{
    private $sender;
    private $receiver;

    public function __construct($messageID = null, $identifier = 'IFTSTA', $version = 'D', $release = '10A', $controllingAgency = 'UN', $association = null)
    {
        parent::__construct($identifier, $version, $release, $controllingAgency, $messageID, $association);

        $this->messages = [];
    }

    public function addMessage($message) {
        $this->messageContent = $message;
        return $this;
    }

    public function getComposed()
    {
        if ($this->composed === null) {
            $this->compose();
        }
        return $this->composed;
    }


}