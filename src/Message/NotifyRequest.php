<?php

namespace Omnipay\IPay88\Message;

use Omnipay\Common\Message\NotificationInterface;

/**
 * Capture the incoming Transaction Status message from senangPay.
 */
class NotifyRequest extends AbstractRequest implements NotificationInterface
{
    protected $data;

    public function getData()
    {
        if (isset($this->data)) {
            return $this->data;
        }

        $data = array_merge($this->httpRequest->query->all(), $this->httpRequest->request->all());

        return $this->data = $data;
    }

    /**
     * Send an acknowledgement that we have successfully got the data.
     * Here we would also check any hashes of the data sent and raise appropriate
     * exceptions if the data does not look right.
     */
    public function sendData($data)
    {
        return $this->createResponse($data);
    }

    /**
     * The response is a very simple message for returning an acknowledgement to Payone.
     */
    protected function createResponse($data)
    {
        return $this->response = new NotifyResponse($this, $data);
    }

    public function getTransactionStatus()
    {
        return ($this->data['status_id'] == 1) ? static::STATUS_COMPLETED : static::STATUS_FAILED;
    }

    public function getMessage()
    {
        return null;
    }

    /**
     * Check the hash against the data.
     */
    public function isValid()
    {
        $computedHash = $this->signature(
            $this->getMerchantSecret(),
            $this->data['status_id'],
            $this->data['order_id'],
            $this->data['transaction_id'],
            $this->data['msg']
        );

        return $computedHash === $this->data['hash'];
    }

    protected function signature($secretKey, $status, $orderId, $remoteTransactionId, $msg)
    {
        $paramsInArray = [$secretKey, $status, $orderId, $remoteTransactionId, $msg];

        return $this->createSignatureFromString(implode('', $paramsInArray));
    }
}
