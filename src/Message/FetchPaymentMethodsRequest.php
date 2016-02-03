<?php namespace Omnipay\MultiSafepay\Message;

class FetchPaymentMethodsRequest extends AbstractRequest
{
    /**
     * @return string|null
     */
    public function getCountry()
    {
        return $this->getParameter('country');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setCountry($value)
    {
        return $this->setParameter('country', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        parent::getData();

        $data = array(
            'amount'   => $this->getAmountInteger(),
            'country'  => $this->getCountry(),
            'currency' => $this->getCurrency(),
        );

        return array_filter($data);
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendRequest('GET', '/gateways', $data);

        $this->response = new FetchPaymentMethodsResponse(
            $this,
            $httpResponse->json()
        );

        return $this->response;
    }
}
