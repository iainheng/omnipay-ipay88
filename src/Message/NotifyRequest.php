<?php

namespace Omnipay\IPay88\Message;

use Omnipay\Common\Message\NotificationInterface;

/**
 * Capture the incoming Transaction Status message from Ipay88.
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
            $this->getMerchantKey(),
            $this->getMerchantCode(),
            $this->data['PaymentId'],
            $this->data['RefNo'],
            $this->data['Amount'],
            $this->data['Currency'],
            $this->data['Status']
        );

        return $computedHash === $this->data['Signature'];
    }

    protected function signature($merchantKey, $merchantCode, $paymentId, $refNo, $amount, $currency, $status)
    {
        $amount = str_replace([',', '.'], '', $amount);

        $paramsInArray = [$merchantKey, $merchantCode, $paymentId, $refNo, $amount, $currency, $status];

        return $this->createSignatureFromString(implode('', $paramsInArray));
    }
}
