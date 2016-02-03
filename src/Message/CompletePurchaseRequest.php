<?php namespace Omnipay\MultiSafepay\Message;

class CompletePurchaseRequest extends FetchTransactionRequest
{
    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->validate('transactionId');

        $transactionId = $this->getTransactionId();

        return compact('transactionId');
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendRequest(
            'get',
            '/orders/' . $data['transactionId']
        );

        $this->response = new CompletePurchaseResponse(
            $this,
            $httpResponse->json()
        );

        return $this->response;
    }
}
