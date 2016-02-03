<?php namespace Omnipay\MultiSafepay\Message;

use Omnipay\Common\Issuer;
use Omnipay\Common\Message\FetchIssuersResponseInterface;

class FetchIssuersResponse extends AbstractResponse implements FetchIssuersResponseInterface
{
    /**
     * Return available issuers as an associative array.
     *
     * @return \Omnipay\Common\Issuer[]
     */
    public function getIssuers()
    {
        $issuers = array();

        foreach ($this->data['data'] as $issuer) {
            $issuers[] = new Issuer(
                $issuer['code'],
                $issuer['description']
            );
        }

        return $issuers;
    }
}
