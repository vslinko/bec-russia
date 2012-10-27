<?php

namespace Rithis\BECRussiaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Rithis\BECRussiaBundle\Entity\News;

class LoadNewsData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $client = $this->container->get('rss_client');
        $client->setFeed('http://www.bec-russia.com/news?format=feed&type=rss', 'default');

        $feeds = $client->fetch('default', 1000);

        foreach ($feeds as $feed) {
            $description = $feed->getDesc();
            $annotation = $this->parseAnnotation($description);

            if (!$annotation) {
                continue;
            }

            $news = new News();
            $news->setTitle($feed->getTitle());
            $news->setAnnotation($annotation);
            $news->setDescription($description);
            $news->setCreatedAt($feed->getPubDate());

            if (strpos($annotation, 'Железнодорожн')) {
                $news->setSchool($this->getReference('school-zhielieznodorozhnyi'));
            }

            if (strpos($annotation, 'Якутск')) {
                if ($news->getSchool()) {
                    $news->setSchool(null);
                } else {
                    $news->setSchool($this->getReference('school-iakutsk'));
                }
            }

            preg_match('/http.+?\.(jpg|gif|png)/', str_replace("\n", "", $description), $matches);
            if (count($matches) > 0) {
                $news->setImage($this->getRemoteMedia($matches[0], 'news'));
            }

            $manager->persist($news);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

    private function parseAnnotation($description)
    {
        $tmp = strip_tags($description);
        $tmp = explode("\n", $tmp);
        $tmp = array_filter($tmp, function ($row) {
            return strlen(trim($row)) > 0;
        });

        if (count($tmp) == 0) {
            return false;
        }

        $annotation = array_shift($tmp);
        while (strlen($annotation) < 100 && count($tmp) > 0) {
            $annotation .= " ";
            $annotation .= array_shift($tmp);
        }

        return $annotation;
    }
}
