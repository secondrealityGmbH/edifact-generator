<?php
namespace EDI\Generator;

class Interchange
{
    /*
     * Interchange header parameters
     */
    protected $interchangeCode;
    protected $sender;
    protected $receiver;
    protected $date;
    protected $time;

    protected $messages;
    protected $composed;

    public function __construct($sender, $receiver, $date = null, $time = null, $interchangeCode = null)
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
    }

    /*
     * Add a Message to the Interchange
     */
    public function addMessage($msg)
    {
        $this->messages[] = $msg;

        return $this;
    }

    /*
     * Format the Interchange segments
     */
    public function compose()
    {
        $temp = [];
        $temp[] = ['UNB', ['UNOA','2'], $this->sender, $this->receiver, [$this->date, $this->time], $this->interchangeCode];
        foreach ($this->messages as $msg) {
            foreach ($msg->getComposed() as $i) {
                $temp[] = $i;
            }
        }
        $temp[] = ['UNZ', count($this->messages), $this->interchangeCode];
        $this->composed = $temp;

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
