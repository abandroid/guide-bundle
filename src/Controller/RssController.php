<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\GuideBundle\Controller;

use Endroid\Guide\Guide;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class RssController
{
    private $guide;
    private $templating;

    public function __construct(Guide $guide, Environment $templating)
    {
        $this->guide = $guide;
        $this->templating = $templating;
    }

    /**
     * @Route("/rss", defaults={"_format"="xml"}, name="guide_rss")
     */
    public function __invoke(): Response
    {
        $shows = $this->guide->load();

        foreach ($shows as &$show) {
            foreach ($show['results'] as &$result) {
                $result['guid'] = hash('sha256', $show['label'].$result['label']);
            }
        }

        return new Response($this->templating->render('rss.xml.twig', ['shows' => $shows]));
    }
}
