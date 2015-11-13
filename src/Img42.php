<?php

namespace Bex\Behat\ScreenshotExtension\Driver;

use Bex\Behat\ScreenshotExtension\Driver\ImageDriverInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Bex\Behat\ScreenshotExtension\Driver\Service\Img42Api;

class Img42 implements ImageDriverInterface
{
    /**
     * @var Img42Api
     */
    private $api;

    /**
     * @param Img42Api $api
     */
    public function __construct(Img42Api $api = null)
    {
        $this->api = $api ?: new Img42Api();
    }

    /**
     * @param  ArrayNodeDefinition $builder
     */
    public function configure(ArrayNodeDefinition $builder)
    {
        // no additional configuration required
        // all uploaded image will live for 10 minutes
        // it can't be configured during the image upload
    }

    /**
     * @param  ContainerBuilder $container
     * @param  array            $config
     */
    public function load(ContainerBuilder $container, array $config)
    {
        // there isn't any configuration for this image upload driver
    }

    /**
     * @param string $binaryImage
     * @param string $filename
     *
     * @return string URL to the image
     */
    public function upload($binaryImage, $filename)
    {
        return $this->api->call($binaryImage);
    }
}