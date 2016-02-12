<?php namespace Omnipay\MultiSafepay;

use Omnipay\Common\AbstractGateway;

/**
 * MultiSafepay gateway.
 *
 * @link https://www.multisafepay.com/documentation/doc/API-Reference/
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'MultiSafepay';
    }

    /**
     * Get the gateway parameters
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'apiKey' => '',
            'locale' => 'en',
            'testMode' => false,
        );
    }

    /**
     * Get the locale.
     *
     * Optional ISO 639-1 language code which is used to specify a
     * a language used to display gateway information and other
     * messages in the responses.
     *
     * The default language is English.
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->getParameter('locale');
    }

    /**
     * Set the locale.
     *
     * Optional ISO 639-1 language code which is used to specify a
     * a language used to display gateway information and other
     * messages in the responses.
     *
     * The default language is English.
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setLocale($value)
    {
        return $this->setParameter('locale', $value);
    }

    /**
     * Get the gateway API Key
     *
     * Authentication is by means of a single secret API key set as
     * the apiKey parameter when creating the gateway object.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * Set the gateway API Key
     *
     * Authentication is by means of a single secret API key set as
     * the apiKey parameter when creating the gateway object.
     *
     * @param string $value
     * @return Gateway provides a fluent interface.
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Retrieve payment methods active on the given MultiSafepay
     * account.
     *
     * @param array $parameters
     *
     * @return \Omnipay\MultiSafepay\Message\FetchPaymentMethodsRequest
     */
    public function fetchPaymentMethods(array $parameters = array())
    {
        return $this->createRequest('Omnipay\MultiSafepay\Message\FetchPaymentMethodsRequest', $parameters);
    }

    /**
     * Retrieve issuers for gateway.
     *
     * @param array $parameters
     *
     * @return \Omnipay\MultiSafepay\Message\FetchIssuersRequest
     */
    public function fetchIssuers(array $parameters = array())
    {
        return $this->createRequest('Omnipay\MultiSafepay\Message\FetchIssuersRequest', $parameters);
    }

    /**
     * Retrieve transaction by the given identifier.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchTransaction(array $parameters = array())
    {
        return $this->createRequest('Omnipay\MultiSafepay\Message\FetchTransactionRequest', $parameters);
    }

    /**
     * Create a refund.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('Omnipay\MultiSafepay\Message\RefundRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\MultiSafepay\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('Omnipay\MultiSafepay\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\MultiSafepay\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('Omnipay\MultiSafepay\Message\CompletePurchaseRequest', $parameters);
    }
}
