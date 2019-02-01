<?php
/**
 * Created by PhpStorm.
 * User: fstuhec
 * Date: 09.10.2017
 * Time: 16:38
 */

namespace EDI\Generator\Iftsta;

use EDI\Generator\Message;

class Status extends Message {

    protected $messageContent;

    protected $messagePrefix;
    protected $messageID;
    protected $dtmSend;
    protected $dtm183;
    protected $dtm132;
    protected $dtm133;
    protected $messageSenderCompany;
    protected $messageReceiver;
    protected $rffAWB;
    protected $rffAWM;
    protected $cnt7;
    protected $cnt11;
    protected $cnt10;
    protected $loc8;
    protected $loc9;
    protected $cni;
    protected $sts;
    protected $tdt;
    protected $ctaIC;
    protected $ftxtra;


    /**
     * @return mixed
     */
    public function getMessageID()
    {
        return $this->messageID;
    }

    /**
     * @param mixed $messageID
     * @return Status
     */
    public function setMessageID($messageID)
    {
        $this->messageID = $messageID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessagePrefix()
    {
        return $this->messagePrefix;
    }

    /**
     * @param mixed $messagePrefix
     * @return Status
     */
    public function setMessagePrefix($messagePrefix)
    {
        $this->messagePrefix = $messagePrefix;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRffAWB()
    {
        return $this->rffAWB;
    }

    /**
     * @param mixed $rffAWB
     * @return Status
     */
    public function setRffAWB($rffAWB)
    {
        $this->rffAWB = ['RFF', ['AWB',$rffAWB]];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCni()
    {
        return $this->cni;
    }

    /**
     * @param mixed $cni
     * @return Status
     */
    public function setCni($cni)
    {
        $this->cni = ['CNI', '1', $cni];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSts()
    {
        return $this->sts;
    }

    /**
     * @param mixed $sts
     * @return Status
     */
    public function setSts($sts,$reason=null)
    {
        $this->sts = ['STS', '1', $sts];
        if (!is_null($reason)) $this->sts[] = $reason;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTdt()
    {
        return $this->tdt;
    }

    /**
     * @param mixed $tdt
     * @return Status
     */
    public function setTdt($flight,$carrier,$type,$origin)
    {
        $this->tdt = ['TDT', '20', $flight,'40','',$carrier,'','',['','','',$type,$origin]];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtm183()
    {
        return $this->dtm183;
    }

    /**
     * @param mixed $dtm183
     * @return Status
     */
    public function setDtm183($dtm183)
    {
        $this->dtm183 = self::dtmSegment(183, $dtm183);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtm132()
    {
        return $this->dtm132;
    }

    /**
     * @param mixed $dtm132
     * @return Status
     */
    public function setDtm132($dtm132)
    {
        $this->dtm132 = self::dtmSegment(132, $dtm132);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtm133()
    {
        return $this->dtm133;
    }

    /**
     * @param mixed $dtm133
     * @return Status
     */
    public function setDtm133($dtm133)
    {
        $this->dtm133 = self::dtmSegment(133, $dtm133);
        return $this;
    }



    /**
     * @return mixed
     */
    public function getRffAWM()
    {
        return $this->rffAWM;
    }

    /**
     * @param mixed $rffAWM
     * @return Status
     */
    public function setRffAWM($rffAWM)
    {
        $this->rffAWM = ['RFF', ['AWM',$rffAWM]];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCnt7()
    {
        return $this->cnt7;
    }

    /**
     * @param mixed $cnt7
     * @return Status
     */
    public function setCnt7($cnt7)
    {
        $this->cnt7 = ['CNT', ['7',$cnt7,'KGM']];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCnt11()
    {
        return $this->cnt11;
    }

    /**
     * @param mixed $cnt11
     * @return Status
     */
    public function setCnt11($cnt11)
    {
        $this->cnt11 = ['CNT', ['11',$cnt11,'NMP']];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCnt10()
    {
        return $this->cnt10;
    }

    /**
     * @param mixed $cnt10
     * @return Status
     */
    public function setCnt10($cnt10)
    {
        $this->cnt10  = ['CNT', ['10',$cnt10,'NMP']];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLoc8()
    {
        return $this->loc8;
    }

    /**
     * @param mixed $loc8
     * @return Status
     */
    public function setLoc8($country,$code,$city)
    {
        $this->loc8 = ['LOC', '8', [$country.$code,'','',$city]];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLoc9()
    {
        return $this->loc9;
    }

    /**
     * @param mixed $loc9
     * @return Status
     */
    public function setLoc9($country,$code,$city)
    {
        $this->loc9 = ['LOC', '9', [$country.$code,'','',$city]];
        return $this;
    }


    /**
     * @return mixed
     */
    public function getDtmSend()
    {
        return $this->dtmSend;
    }

    /**
     * @param mixed $dtmsend
     * @return Status
     */
    public function setDTMMessageSendingTime($dtm)
    {
        $this->dtmSend = self::dtmSegment(137, $dtm);
        return $this;
    }


    public function setMessageSenderCompany($identifier,$receiverCode,$company)
    {
        $this->messageSenderCompany = ['NAD', 'FW', [$identifier,'',$receiverCode], '', $company['name'],$company['street'],$company['city'],$company['state'],$company['zip'],$company['country']];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessageReceiver()
    {
        return $this->messageReceiver;
    }

    /**
     * @param mixed $messageReceiver
     * @return Status
     */
    public function setMessageReceiver($messageReceiver,$receiverCode)
    {
        $this->messageReceiver = ['NAD', 'MR', [$messageReceiver,'',$receiverCode]];
        return $this;
    }



    /**
     * @return mixed
     */
    public function getCtaIC()
    {
        return $this->ctaIC;
    }

    /**
     * @param mixed $ctaIC
     * @return Status
     */
    public function setCtaIC($name)
    {
        $this->ctaIC =  ['CTA', 'IC', $name];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFtxtra()
    {
        return $this->ftxtra;
    }

    /**
     * @param mixed $ftxtra
     * @return Status
     */
    public function setFtxtra($ftxtra)
    {
        $this->ftxtra =  ['FTX', 'TRA','','',$ftxtra];
        return $this;
    }






    public function __construct()
    {
        $this->messageContent = [];
    }


    public function compose($msgStatus = 9, $documentCode = 44)
    {
        $this->messageContent[] = ['BGM', $documentCode, $this->messagePrefix.$this->messageID, $msgStatus];

        /* message creation date and time */
        $this->messageContent[] = $this->dtmSend;


        if ($this->messageSenderCompany !== null) {
            $this->messageContent[] = $this->messageSenderCompany;
        }

        if ($this->messageReceiver !== null) {
            $this->messageContent[] = $this->messageReceiver;
        }

        if ($this->rffAWB !== null) {
            $this->messageContent[] = $this->rffAWB;
        }

        if ($this->rffAWM !== null) {
            $this->messageContent[] = $this->rffAWM;
        }

        if ($this->cnt7 !== null) {
            $this->messageContent[] = $this->cnt7;
        }

        if ($this->cnt11 !== null) {
            $this->messageContent[] = $this->cnt11;
        }

        if ($this->cnt10 !== null) {
            $this->messageContent[] = $this->cnt10;
        }

        if ($this->cni !== null) {
            $this->messageContent[] = $this->cni;
        }

        if ($this->sts !== null) {
            $this->messageContent[] = $this->sts;
        }

        if ($this->dtm183 !== null) {
            $this->messageContent[] = $this->dtm183;
        }

        if ($this->dtm132 !== null && $this->sts[2]=="20") {
            $this->messageContent[] = $this->dtm132;
        }

        if ($this->ctaIC !== null) {
            $this->messageContent[] = ['NAD', 'UC'];
            $this->messageContent[] = $this->ctaIC;
        }

        if ($this->ftxtra !== null) {
            $this->messageContent[] = $this->ftxtra;
        }


        if ($this->tdt !== null) {
            $this->messageContent[] = $this->tdt;
        }
        else  $this->messageContent[] = ['TDT', 20];


        if ($this->loc9 !== null) {
            $this->messageContent[] = $this->loc9;
        }

        if ($this->dtm133 !== null) {
            $this->messageContent[] = $this->dtm133;
        }

        if ($this->loc8 !== null) {
            $this->messageContent[] = $this->loc8;
        }

        if ($this->dtm132 !== null && $this->sts[2]=="27") {
            $this->messageContent[] = $this->dtm132;
        }

       return $this->messageContent;

    }


}