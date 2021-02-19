<?php

namespace Omnipay\IPay88\Message;


use Omnipay\Common\Currency;

class CompletePurchaseRequest extends AbstractRequest
{
    protected $endpoint = 'https://www.mobile88.com/epayment/enquiry.asp';

    public function getData()
    {
        $this->guardParameters();

        $data = $this->httpRequest->request->all();

        $data['ComputedSignature'] = $this->signature(
            $this->getMerchantKey(),
            $this->getMerchantCode(),
            $data['PaymentId'],
            $data['RefNo'],
            $data['Amount'],
            $data['Currency'],
            $data['Status']
        );

        return $data;
    }

    public function sendData($data)
    {
		if ($this->getRequeryNeeded()) {
			$endpoint = $this->getTestMode() ? $this->getSandboxRequeryUrl() : $this->endpoint;

			$data['ReQueryStatus'] = $this->httpClient->post($endpoint, [
			    'Content-Type' => 'application/x-www-form-urlencoded'
            ], [
				'MerchantCode' => $this->getMerchantCode(),
				'RefNo' => $data['RefNo'],
				'Amount' => $data['Amount'],
			])->getBody()->getContents();

		} else {
			$data = $this->getData();
		}

        return $this->response = new CompletePurchaseResponse($this, $data);
    }

    public function isValid()
    {
        $data = $this->getData();

        $computedHash = $this->signature(
            $this->getMerchantKey(),
            $this->getMerchantCode(),
            $data['PaymentId'],
            $data['RefNo'],
            $data['Amount'],
            $data['Currency'],
            $data['Status']
        );

        return $computedHash === $data['Signature'];
    }

    protected function signature($merchantKey, $merchantCode, $paymentId, $refNo, $amount, $currency, $status)
    {
        $amount = str_replace([',', '.'], '', $amount);

        $paramsInArray = [$merchantKey, $merchantCode, $paymentId, $refNo, $amount, $currency, $status];

        return $this->createSignatureFromString(implode('', $paramsInArray));
    }
}
