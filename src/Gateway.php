<?php

namespace Omnipay\IPay88;

use Omnipay\Common\AbstractGateway;
use Omnipay\IPay88\Message\NotifyRequest;

/**
 * iPay88 Gateway Driver for Omnipay
 *
 * This driver is based on
 * Online Payment Switching Gateway Technical Specification Version 1.6.1
 * @link https://drive.google.com/file/d/0B4YUBYSgSzmAbGpjUXMyMWx6S2s/view?usp=sharing
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'iPay88';
    }

    public function getDefaultParameters()
    {
        return [
            'merchantKey' => '',
            'merchantCode' => '',
            'backendUrl' => '',
            'sandbox' => false,
            'requeryNeeded' => true,
            'notifyOkText' => 'RECEIVEOK',
        ];
    }

    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }

    public function setMerchantKey($merchantKey)
    {
        return $this->setParameter('merchantKey', $merchantKey);
    }

    public function getMerchantCode()
    {
        return $this->getParameter('merchantCode');
    }

    public function setMerchantCode($merchantCode)
    {
        return $this->setParameter('merchantCode', $merchantCode);
    }

    public function getBackendUrl()
    {
        return $this->getParameter('backendUrl');
    }

    public function setBackendUrl($backendUrl)
    {
        return $this->setParameter('backendUrl', $backendUrl);
    }

    public function getSandboxUrl()
    {
        return $this->getParameter('sandboxUrl');
    }

    public function setSandboxUrl($sandboxUrl)
    {
        return $this->setParameter('sandboxUrl', $sandboxUrl);
    }

    public function getSandbox()
    {
        return $this->getParameter('sandbox');
    }

    public function setSandbox($sandbox)
    {
        return $this->setParameter('sandbox', $sandbox);
    }

    public function getRequeryNeeded()
    {
        return $this->getParameter('requeryNeeded');
    }

    public function setRequeryNeeded($requeryNeeded)
    {
        return $this->setParameter('requeryNeeded', $requeryNeeded);
    }

    public function getSandboxRequeryUrl()
    {
        return $this->getParameter('sandboxRequeryUrl');
    }

    public function setSandboxRequeryUrl($sandboxUrl)
    {
        return $this->setParameter('sandboxRequeryUrl', $sandboxUrl);
    }

    public function requery(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\IPay88\Message\RequeryRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\IPay88\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\IPay88\Message\CompletePurchaseRequest', $parameters);
    }

    /**
     * Accept an incoming notification (a ServerRequest).
     * This API supports the notification responses as a suplement to the direct server responses.
     */
    public function acceptNotification(array $parameters = array())
    {
        return $this->createRequest(NotifyRequest::class, $parameters);
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
    }

}
