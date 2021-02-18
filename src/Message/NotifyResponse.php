<?php

namespace Omnipay\IPay88\Message;

/**
 * Acknowledge the incoming Transaction Status message.
 */

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Exception\InvalidResponseException;

class NotifyResponse extends CompletePurchaseResponse
{
    protected $responseMessage = 'RECEIVEOK';

    /**
     * Whether to exit immediately on responding.
     */
    protected $exitOnResponse = true;

    /**
     * @param bool $exit
     */
    public function acknowledge($exit = true)
    {
        // Only send the OK message if the hash has been successfuly verified.
        if ($this->isSuccessful()) {
            echo $this->responseMessage;
        }

        if ($exit) {
            exit;
        }
    }

    public function accept()
    {
        $this->acknowledge($this->exitOnResponse);
    }

    public function reject()
    {
        // Don't output anything - just exit.
        if ($this->exitOnResponse) {
            exit;
        }
    }

    /**
     * Set or reset flag to exit immediately on responding.
     * Switch auto-exit off if you have further processing to do.
     *
     * @param boolean true to exit; false to not exit.
     */
    public function setExitOnResponse($value)
    {
        $this->exitOnResponse = (bool)$value;
    }

    /**
     * Alias of acknowledge as a more consistent OmniPay lexicon.
     */
    public function send($exit = true)
    {
        $this->acknowledge($exit);
    }
}
