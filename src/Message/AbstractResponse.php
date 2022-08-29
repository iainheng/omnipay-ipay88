<?php

namespace Omnipay\IPay88\Message;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    public function getOrderNumber()
    {
        return $this->getTransactionId();
    }
}
