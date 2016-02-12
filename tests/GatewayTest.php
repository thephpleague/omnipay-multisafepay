<?php namespace Omnipay\MultiSafepay;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var Gateway
     */
    protected $gateway;

    protected function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway(
            $this->getHttpClient(),
            $this->getHttpRequest()
        );

        $this->gateway->setApiKey('123456789');
    }

    public function testFetchPaymentMethodsRequest()
    {
        $request = $this->gateway->fetchPaymentMethods(
            array('country' => 'NL')
        );

        $this->assertInstanceOf('Omnipay\MultiSafepay\Message\FetchPaymentMethodsRequest', $request);
        $this->assertEquals('NL', $request->getCountry());
    }

    public function testFetchIssuersRequest()
    {
        $request = $this->gateway->fetchIssuers();

        $this->assertInstanceOf('Omnipay\MultiSafepay\Message\FetchIssuersRequest', $request);
    }

    public function testPurchaseRequest()
    {
        $request = $this->gateway->purchase(array('amount' => 10.00));

        $this->assertInstanceOf('Omnipay\MultiSafepay\Message\PurchaseRequest', $request);
        $this->assertEquals($request->getAmount(), 10.00);
    }

    public function testCompletePurchaseRequest()
    {
        $request = $this->gateway->completePurchase(array('amount' => 10.00));

        $this->assertInstanceOf('Omnipay\MultiSafepay\Message\CompletePurchaseRequest', $request);
        $this->assertEquals($request->getAmount(), 10.00);
    }
}
