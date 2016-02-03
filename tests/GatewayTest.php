<?php namespace Omnipay\MultiSafepay;

use Omnipay\MultiSafepay\Message\CompletePurchaseRequest;
use Omnipay\MultiSafepay\Message\FetchIssuersRequest;
use Omnipay\MultiSafepay\Message\FetchPaymentMethodsRequest;
use Omnipay\MultiSafepay\Message\PurchaseRequest;
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

        $this->assertInstanceOf(FetchPaymentMethodsRequest::class, $request);
        $this->assertEquals('NL', $request->getCountry());
    }

    public function testFetchIssuersRequest()
    {
        $request = $this->gateway->fetchIssuers();

        $this->assertInstanceOf(FetchIssuersRequest::class, $request);
    }

    public function testPurchaseRequest()
    {
        $request = $this->gateway->purchase(array('amount' => 10.00));

        $this->assertInstanceOf(PurchaseRequest::class, $request);
        $this->assertEquals($request->getAmount(), 10.00);
    }

    public function testCompletePurchaseRequest()
    {
        $request = $this->gateway->completePurchase(array('amount' => 10.00));

        $this->assertInstanceOf(CompletePurchaseRequest::class, $request);
        $this->assertEquals($request->getAmount(), 10.00);
    }
}
