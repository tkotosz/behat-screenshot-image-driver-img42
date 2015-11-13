<?php

namespace Bex\Behat\ScreenshotExtension\Driver\Service;

use Buzz\Client\Curl;
use Buzz\Message\Request;
use Buzz\Message\RequestInterface;
use Buzz\Message\Response;

class Img42Api
{
    const REQUEST_URL = 'https://img42.com';
    const IMAGE_BASE_URL = 'https://img42.com/';

    /**
     * @var Curl
     */
    private $client;

    /**
     * @param Curl $client
     */
    public function __construct(Curl $client = null)
    {
        $this->client = $client ?: new Curl();
    }

    /**
     * @param  string $binaryImage
     *
     * @return string
     */
    public function call($binaryImage)
    {
        $response = new Response();

        $request = $this->buildRequest($binaryImage);
        $this->client->setOption(CURLOPT_BINARYTRANSFER, true);
        $this->client->setOption(CURLOPT_TIMEOUT, 10000);
        $this->client->send($request, $response);

        return $this->processResponse($response);
    }

    /**
     * @param  Response $response
     *
     * @return string
     */
    private function processResponse(Response $response)
    {
        $responseData = json_decode($response->getContent(), true);

        if (!isset($responseData['id'])) {
            throw new \RuntimeException('Screenshot upload failed');
        }

        return self::IMAGE_BASE_URL . $responseData['id'];
    }

    /**
     * @param  string $binaryImage
     *
     * @return Request
     */
    private function buildRequest($binaryImage)
    {
        $request = new Request(RequestInterface::METHOD_POST);

        $request->fromUrl(self::REQUEST_URL);
        $request->setContent($binaryImage);

        return $request;
    }
}