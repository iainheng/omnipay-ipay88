<?php
namespace Omnipay\IPay88;

use Omnipay\Common\AbstractGateway;

/**
 * iPay8 Gateway Driver for Omnipay
 *
 * This driver is based on
 * Online Payment Switching Gateway Technical Specification Version 1.6.1
 * @link https://drive.google.com/file/d/0B4YUBYSgSzmAbGpjUXMyMWx6S2s/view?usp=sharing
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
	
	public function getSandboxUrl() {
		return $this->getParameter('sandboxUrl');
	}
	
	public function setSandboxUrl($sandboxUrl) {
		return $this->setParameter('sandboxUrl', $sandboxUrl);
	}
	
	public function getSandbox() {
		return $this->getParameter('sandbox');
	}
	
	public function setSandbox($sandbox) {
		return $this->setParameter('sandbox', $sandbox);
	}
	
	public function getRequeryNeeded() {
		return $this->getParameter('requeryNeeded');
    }

    public function setRequeryNeeded($requeryNeeded)
    {
        return $this->setParameter('requeryNeeded', $requeryNeeded);
    }
	
	public function getSandboxRequeryUrl() {
		return $this->getParameter('sandboxRequeryUrl');
    }

    public function setSandboxRequeryUrl($sandboxUrl)
    {
        return $this->setParameter('sandboxRequeryUrl', $sandboxUrl);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\IPay88\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\IPay88\Message\CompletePurchaseRequest', $parameters);
    }

}