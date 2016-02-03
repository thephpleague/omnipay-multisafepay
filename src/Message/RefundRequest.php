<?php namespace Omnipay\MultiSafepay\Message;

use Omnipay\Common\Message\ResponseInterface;

class RefundRequest extends AbstractRequest
{
    public function getData()
    {
        parent::getData();

        $this->validate('amount', 'currency', 'description', 'transactionId');

        return array(
            'amount' => $this->getAmountInteger(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
            'id' => $this->getTransactionId(),
            'type' => 'refund',
        );
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendRequest(
            'POST',
            '/orders/' . $data['id'] . '/refunds',
            $data
        );

        $this->response = new RefundResponse($this, $httpResponse);

        return $this->response;
    }
}
