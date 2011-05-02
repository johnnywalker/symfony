<?php

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Symfony\Bundle\AsseticBundle\Factory\Resource;

use Assetic\Factory\Resource\ResourceInterface;
use Symfony\Component\Config\FileLocatorInterface;

/**
 * A regular file resource (instead of a template)
 *
 * @author Johnny Walker <kallous@gmail.com>
 */
class RegularFileResource implements ResourceInterface
{
    protected $locator;
    protected $path;
    
    private $isLocated = false;
    
    public function __construct(FileLocatorInterface $locator, $path)
    {
        $this->locator = $locator;
        $this->path    = $path;
    }

    public function isFresh($timestamp)
    {
        if (!$this->isLocated)
            $this->locateResource();
        
        return file_exists($this->path) && filemtime($this->path) <= $timestamp;
    }

    public function getContent()
    {
        if (!$this->isLocated)
            $this->locateResource();
        
        return file_exists($this->path) ? file_get_contents($this->path) : '';
    }

    public function __toString()
    {
        if (!$this->isLocated)
            $this->locateResource();
        
        return $this->path;
    }
    
    protected function locateResource() {
        if ($this->isLocated) {
            throw new \LogicException('Resource already located.');
        }
        
        $this->path = $this->locator->locate($this->path);
        $this->isLocated = true;
    }
}

?>
