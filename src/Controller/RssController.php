<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\GuideBundle\Controller;

use Endroid\Guide\Guide;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class RssController
{
    private $guide;
    private $templating;

    public function __construct(Guide $guide, Environment $templating)
    {
        $this->guide = $guide;
        $this->templating = $templating;
    }

    public function __invoke(): Response
    {
        $shows = $this->guide->load();

        foreach ($shows as &$show) {
            foreach ($show['results'] as &$result) {
                $result['guid'] = hash('sha256', $show['label'].$result['label']);
            }
        }

        $xml = $this->templating->render('@EndroidGuide/rss.xml.twig', ['shows' => $shows]);

        return new Response($xml, Response::HTTP_OK, ['Content-Type' => 'text/xml']);
    }
}
