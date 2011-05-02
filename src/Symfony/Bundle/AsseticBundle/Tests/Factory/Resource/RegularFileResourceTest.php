<?php

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Symfony\Bundle\AsseticBundle\Tests\Factory\Resource;

use Symfony\Bundle\AsseticBundle\Factory\Resource\RegularFileResource;

class RegularFileResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $locator;

    protected function setUp()
    {
        $this->locator = $this->getMock('Symfony\\Component\\Config\FileLocatorInterface');
        $this->locator
            ->expects($this->any())
            ->method('locate')
            ->withAnyParameters()
            ->will($this->returnArgument(0));
    }

    public function testIsFresh()
    {
        $regRes = new RegularFileResource($this->locator, __FILE__);
        $this->assertTrue($regRes->isFresh(filemtime(__FILE__)));
        $this->assertFalse($regRes->isFresh(filemtime(__FILE__)-1));
    }
}
