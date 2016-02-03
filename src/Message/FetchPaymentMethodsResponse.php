<?php namespace Omnipay\MultiSafepay\Message;

use Omnipay\Common\Message\FetchPaymentMethodsResponseInterface;
use Omnipay\Common\PaymentMethod;

class FetchPaymentMethodsResponse extends AbstractResponse implements FetchPaymentMethodsResponseInterface
{
    /**
     * Get the returned list of payment methods.
     *
     * These represent separate payment methods which the user must choose between.
     *
     * @return \Omnipay\Common\PaymentMethod[]
     */
    public function getPaymentMethods()
    {
        $paymentMethods = array();

        foreach ($this->data['data'] as $method) {
            $paymentMethods[] = new PaymentMethod(
                $method['id'],
                $method['description']
            );
        }

        return $paymentMethods;
    }
}
