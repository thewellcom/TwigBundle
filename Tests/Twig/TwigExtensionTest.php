<?php

namespace TheWellCom\Tests\Twig;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use TheWellCom\TwigBundle\Twig\TwigExtension;

class TwigExtensionTest extends KernelTestCase
{
    /**
     * @dataProvider phoneFilterTestProvider
     */
    public function testPhoneFilter($phoneTransformedExpected, $phone, $interval)
    {
        $twigExtension = new TwigExtension();
        $this->assertEquals($phoneTransformedExpected, $twigExtension->phoneFilter($phone, $interval));
    }

    public function phoneFilterTestProvider()
    {
        return array(
            array('09 87 65 43 21', '0987654321', ' '),
            array('09 87 65 43 21', '0987654321', ' '),
            array('09 87 65 43 21', '0987654321', ' '),
            array('09-87-65-43-21', '0987654321', '-'),
            array('09.87.65.43.21', '0987654321', '.'),
        );
    }
}
