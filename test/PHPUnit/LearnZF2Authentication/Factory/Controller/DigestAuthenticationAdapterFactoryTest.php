<?php

/**
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace ZF2AuthenticationTest\Factory;

use PHPUnit_Framework_TestCase;
use ZF2Authentication\Factory\DigestAuthenticationAdapterFactory;
use test\Bootstrap;

class DigestAuthenticationAdapterFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var BasicAuthenticationAdapterFactory $digestFactory */
    private $digestFactory;

    /** @var Zend\ServiceManager\ServiceLocator $digestServiceLocator */
    private $digestServiceLocator;

    /** @var Zend\ServiceManager\ServiceManager $digestServiceManager */
    private $digestServiceManager;

    public function setUp()
    {
        $this->digestServiceLocator = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');
        $this->digestServiceManager = Bootstrap::getServiceManager();
        $this->digestFactory = new DigestAuthenticationAdapterFactory($this->digestServiceManager->get('Config'));
    }

    public function testCreateDigestService()
    {
        $digest = $this->digestFactory->createService($this->digestServiceLocator->reveal());
        $this->assertInstanceOf('Zend\Authentication\Adapter\Http', $digest);
    }
}
