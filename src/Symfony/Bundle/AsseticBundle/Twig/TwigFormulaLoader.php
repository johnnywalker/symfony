<?php

/*
 * This file is part of the Assetic package, an OpenSky project.
 *
 * (c) 2010-2011 OpenSky Project Inc
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\AsseticBundle\Twig;

use Assetic\Extension\Twig\TwigFormulaLoader as BaseTwigFormulaLoader;
use Assetic\Factory\Resource\ResourceInterface;

/**
 * Loads asset formulae from Twig templates.
 *
 * @author Kris Wallsmith <kris.wallsmith@gmail.com>
 */
class TwigFormulaLoader extends BaseTwigFormulaLoader
{
    /**
     * Returns the logical name for the specified resource (e.g. AcmeTestBundle:Controller:example.css.twig)
     *
     * @param ResourceInterface $resource The resource for which a name is required
     * @return string The resource's unique name
     */
    static protected function getResourceName(ResourceInterface $resource)
    {
        return $resource->getLogicalName();
    }
}
