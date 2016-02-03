<?php namespace Omnipay\MultiSafepay\Message;

use Guzzle\Common\Event;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * Live API endpoint.
     *
     * This endpoint will be used when the test mode is disabled.
     *
     * @var string
     */
    protected $liveEndpoint = 'https://api.multisafepay.com/v1/json';

    /**
     * Test API endpoint.
     *
     * This endpoint will be used when the test mode is enabled.
     *
     * @var string
     */
    protected $testEndpoint = 'https://testapi.multisafepay.com/v1/json';

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
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get endpoint.
     *
     * @return string
     */
    public function getEndpoint()
    {
        if ($this->getTestMode()) {
            return $this->testEndpoint;
        }

        return $this->liveEndpoint;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->validate('apiKey');
    }

    /**
     * @param $method
     * @param $endpoint
     * @param null $query
     * @param null $data
     * @return \Guzzle\Http\Message\Response
     */
    protected function sendRequest($method, $endpoint, $query = null, $data = null)
    {
        $this->httpClient->getEventDispatcher()->addListener('request.error', function (Event $event) {
            /**
             * @var \Guzzle\Http\Message\Response $response
             */
            $response = $event['response'];
            if ($response->isError()) {
                $event->stopPropagation();
            }
        });

        $httpRequest = $this->httpClient->createRequest(
            $method,
            $this->getEndpoint() . $endpoint,
            array(
                'api_key' => $this->getApiKey(),
            ),
            $data
        );

        // Add query parameters
        if (is_array($query) && ! empty($query)) {
            foreach ($query as $itemKey => $itemValue) {
                $httpRequest->getQuery()->add($itemKey, $itemValue);
            }
        }

        return $httpRequest->send();
    }
}
