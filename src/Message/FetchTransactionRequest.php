<?php namespace Omnipay\MultiSafepay\Message;

class FetchTransactionRequest extends AbstractRequest
{
    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        parent::getData();

        $this->validate('transactionId');

        $transactionId = $this->getTransactionId();

        return compact('transactionId');
    }

    /**
     * {@inheritDoc}
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendRequest(
            'get',
            '/orders/' . $data['transactionId']
        );

        $this->response = new FetchTransactionResponse(
            $this,
            $httpResponse->json()
        );

        return $this->response;
    }
}
