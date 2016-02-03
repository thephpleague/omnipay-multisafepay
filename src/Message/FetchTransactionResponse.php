<?php namespace Omnipay\MultiSafepay\Message;

class FetchTransactionResponse extends AbstractResponse
{
    /**
     * Is the payment created, but uncompleted?
     *
     * @return boolean
     */
    public function isInitialized()
    {
        return $this->getPaymentStatus() == 'initialized';
    }

    /**
     * Is the payment created, but not yet exempted (credit cards)?
     *
     * @return boolean
     */
    public function isUncleared()
    {
        return $this->getPaymentStatus() == 'uncleared';
    }

    /**
     * Is the payment canceled?
     *
     * @return boolean
     */
    public function isCanceled()
    {
        return $this->getPaymentStatus() == 'canceled';
    }

    /**
     * Is the payment rejected?
     *
     * @return boolean
     */
    public function isDeclined()
    {
        return $this->getPaymentStatus() == 'declined';
    }

    /**
     * Is the payment refunded?
     *
     * @return boolean
     */
    public function isRefunded()
    {
        if ($this->getPaymentStatus() == 'refunded' ||
            $this->getPaymentStatus() == 'chargedback'
        ) {
            return true;
        }

        return false;
    }

    /**
     * Is the payment expired?
     *
     * @return boolean
     */
    public function isExpired()
    {
        return $this->getPaymentStatus() == 'expired';
    }

    /**
     * Get raw payment status.
     *
     * @return null|string
     */
    public function getPaymentStatus()
    {
        if (isset($this->data['data']['status'])) {
            return $this->data['data']['status'];
        }
    }
}
