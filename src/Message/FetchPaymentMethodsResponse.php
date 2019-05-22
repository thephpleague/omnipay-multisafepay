<?php
/**
 * MultiSafepay XML Api Fetch Payment Methods Response.
 */

namespace Omnipay\MultiSafepay\Message;

use Omnipay\Common\Message\FetchPaymentMethodsResponseInterface;
use Omnipay\Common\PaymentMethod;

/**
 * MultiSafepat XML Api Fetch Payment Methods Response.
 *
 * @deprecated This API is deprecated and will be removed in
 * an upcoming version of this package. Please switch to the Rest API.
 */
class FetchPaymentMethodsResponse extends AbstractResponse implements FetchPaymentMethodsResponseInterface
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return isset($this->data->gateways);
    }

    /**
     * Return available payment methods as an associative array.
     *
     * @return array
     */
    public function getPaymentMethods()
    {
        $result = [];

        foreach ($this->data->gateways->gateway as $gateway) {
            $result[] = new PaymentMethod((string) $gateway->id, (string) $gateway->description);
        }

        return $result;
    }
}
