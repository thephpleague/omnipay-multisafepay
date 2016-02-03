<?php namespace Omnipay\MultiSafepay\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * {@inheritdoc}
     */
    public function isRedirect()
    {
        return isset($this->data['data']['payment_url']);
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUrl()
    {
        if (! $this->isRedirect()) {
            return null;
        }

        return $this->data['data']['payment_url'];
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectData()
    {
        return null;
    }
}
