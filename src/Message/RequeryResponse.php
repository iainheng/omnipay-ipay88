<?php

namespace Omnipay\IPay88\Message;


use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class RequeryResponse extends AbstractResponse
{
    private $reQueryResponse = [
        '00' => 'Successful payment',
        'Invalid parameters' => 'Parameters pass in incorrect',
        'Record not found' => 'Cannot found the record',
        'Incorrect amount' => 'Amount different',
        'Payment fail' => 'Payment fail',
        'M88Admin' => 'Payment status updated by iPay88 Admin(Fail)'
    ];

    private $invalidSignatureMsg = 'Invalid signature returned from iPay88';

    protected $message;

    protected $status;

    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
		
		if ($this->getRequest()->getRequeryNeeded()) {

			$this->message = isset($this->reQueryResponse[$this->data['ReQueryStatus']]) ? $this->reQueryResponse[$this->data['ReQueryStatus']] : $this->data['ReQueryStatus'];

			$this->status = '00' == $this->data['ReQueryStatus'];
		}
    }

    public function isSuccessful()
    {
        return $this->status;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getTransactionId()
    {
        return $this->data['RefNo'];
    }

}