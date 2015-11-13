<?php

namespace spec\Bex\Behat\ScreenshotExtension\Driver;

use Bex\Behat\ScreenshotExtension\Driver\Service\Img42Api;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Img42Spec extends ObjectBehavior
{
    function let(Img42Api $api)
    {
        $this->beConstructedWith($api);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bex\Behat\ScreenshotExtension\Driver\Img42');
    }

    function it_should_call_the_api_with_the_correct_data(ContainerBuilder $container, Img42Api $api)
    {
        $api->call('imgdata')->shouldBeCalled()->willReturn('imgurl');
        $this->upload('imgdata', 'img_file_name.png')->shouldReturn('imgurl');
    }
}