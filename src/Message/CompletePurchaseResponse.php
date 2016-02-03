<?php namespace Omnipay\MultiSafepay\Message;

class CompletePurchaseResponse extends FetchTransactionResponse
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->getPaymentStatus() == 'completed';
    }
}
