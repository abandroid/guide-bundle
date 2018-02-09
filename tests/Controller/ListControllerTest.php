<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\GuideBundle\Tests;

use Endroid\BundleTest\BundleTestCase;

class ListControllerTest extends BundleTestCase
{
    public function testListController()
    {
        $client = static::createClient();
        $client->request('GET', '/guide/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('Guide', $client->getCrawler()->filter('h1')->text());
    }
}
