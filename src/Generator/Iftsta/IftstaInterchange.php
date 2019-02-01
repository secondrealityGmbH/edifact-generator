<?php
/**
 * Created by PhpStorm.
 * User: fstuhec
 * Date: 11.10.2017
 * Time: 22:11
 */

namespace EDI\Generator\Iftsta;

use EDI\Generator\Interchange;

class IftstaInterchange extends Interchange
{
    protected $syntax;
    protected $version;
    protected $testMode;

    public function __construct($sender, $receiver, $date = null, $time = null, $interchangeCode = null, $syntax = null, $version = null,$testMode = null)
    {
        $this->messages = [];

        if ($interchangeCode === null) {
            $this->interchangeCode = 'I'.strtoupper(uniqid());
        } else {
            $this->interchangeCode = $interchangeCode;
        }

        $this->sender=$sender;
        $this->receiver=$receiver;
        if ($date === null) {
            $this->date = date('ymd');
        } else {
            $this->date = $date;
        }
        if ($time === null) {
            $this->time = date('Hi');
        } else {
            $this->time = $time;
        }

        if ($syntax === null) {
            $this->syntax = "UNOA";
        } else {
            $this->syntax = $syntax;
        }

        if ($version === null) {
            $this->version = 2;
        } else {
            $this->version = $version;
        }

        if ($testMode === null) {
            $this->testMode = 1;
        } else {
            $this->testMode = $testMode;
        }

    }

    /*
    * Set Messages to the Interchange
    */
    public function setMessages($msg)
    {
        $this->messages = $msg;

        return $this;
    }

    public function hasMessages() {
        return count($this->messages);
    }


    public function compose()
    {
        $temp = [];
        $temp[] = ['UNB', [$this->syntax,$this->version], $this->sender, $this->receiver, [$this->date, $this->time], $this->interchangeCode,'','','','',$this->testMode];

        foreach ($this->messages as $msg) {
            foreach ($msg->getComposed() as $i) {
                $temp[] = $i;
            }
        }

        $temp[] = ['UNZ', count($this->messages), $this->interchangeCode];

        $this->composed = $temp;

        return $this;
    }


}