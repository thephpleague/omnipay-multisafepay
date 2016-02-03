<?php namespace Omnipay\MultiSafepay\Message;

use Omnipay\Common\Issuer;
use Omnipay\Tests\TestCase;

class FetchIssuersRequestTest extends TestCase
{
    /**
     * @var FetchIssuersRequest
     */
    private $request;

    protected function setUp()
    {
        $this->request = new FetchIssuersRequest(
            $this->getHttpClient(),
            $this->getHttpRequest()
        );

        $this->request->initialize(
            array(
                'api_key' => '123456789',
                'paymentMethod' => 'IDEAL'
            )
        );
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('FetchIssuersSuccess.txt');

        $response = $this->request->send();

        $issuers = $response->getIssuers();

        $this->assertContainsOnlyInstancesOf(Issuer::class, $issuers);
        $this->assertFalse($response->isRedirect());
        $this->assertInstanceOf(FetchIssuersResponse::class, $response);
        $this->assertInternalType('array', $issuers);

        $this->assertNull($response->getTransactionReference());
        $this->assertTrue($response->isSuccessful());
    }

    public function testIssuerNotFound()
    {
        $this->setMockHttpResponse('FetchIssuersFailure.txt');

        $response = $this->request->send();

        $this->assertEquals('Not found', $response->getMessage());
        $this->assertEquals(404, $response->getCode());
        $this->assertFalse($response->isRedirect());

        $this->assertFalse($response->isSuccessful());
        $this->assertInstanceOf(FetchIssuersResponse::class, $response);
    }
}
