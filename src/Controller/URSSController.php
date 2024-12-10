<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class URSSController extends AbstractController
{ #[Route('/urss', name: 'urss_index')]
    public function index(): Response
    {
        // Contenu humoristique du flux URSS
        $news = [
            [
                'title' => 'Lancement du Samovar en Or Massif',
                'link' => 'https://www.tsarbucks.com/samovar-or',
                'description' => 'Découvrez notre dernière innovation : un samovar impérial pour vos thés russes.',
                'pubDate' => (new \DateTime())->format(DATE_RSS),
            ],
            [
                'title' => 'Ouverture de Tsarbucks en Sibérie',
                'link' => 'https://www.tsarbucks.com/siberie',
                'description' => 'Venez savourer un expresso Romanov au cœur de la toundra sibérienne.',
                'pubDate' => (new \DateTime('-1 day'))->format(DATE_RSS),
            ],
            [
                'title' => 'Macarons impériaux : nouvelle recette',
                'link' => 'https://www.tsarbucks.com/macarons',
                'description' => 'Nos macarons revisitent la tradition culinaire française avec une touche impériale.',
                'pubDate' => (new \DateTime('-2 days'))->format(DATE_RSS),
            ],
        ];

        // Créer un document XML RSS
        $xml = new \SimpleXMLElement('<rss version="2.0"></rss>');
        $channel = $xml->addChild('channel');
        $channel->addChild('title', 'Tsarbucks News');
        $channel->addChild('link', 'https://www.tsarbucks.com');
        $channel->addChild('description', 'Les dernières nouvelles de Tsarbucks');
        
        foreach ($news as $item) {
            $rssItem = $channel->addChild('item');
            $rssItem->addChild('title', $item['title']);
            $rssItem->addChild('link', $item['link']);
            $rssItem->addChild('description', $item['description']);
            $rssItem->addChild('pubDate', $item['pubDate']);
        }

        // Charger le fichier XSLT
        $xslt = new \XSLTProcessor();
        $xsl = new \DOMDocument;
        $xsl->load($this->getParameter('kernel.project_dir') . '/public/rss.xsl');
        $xslt->importStylesheet($xsl);

        // Appliquer XSLT au flux RSS
        $dom = dom_import_simplexml($xml);
        $htmlContent = $xslt->transformToXML($dom->ownerDocument);

        return new Response($htmlContent);
    }
}