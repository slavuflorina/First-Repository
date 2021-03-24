<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Author;
use App\Entity\File;
use App\Entity\Pdf;
use App\Entity\Video;

class InheritanceEntitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1;$i<=2;$i++)
        {
            $author = new Author;
            $author->setName('Author Florina '.$i);
            $manager->persist($author);

        }
        for($i=1;$i<=3;$i++)
        {
            $pdf = new Pdf;
            $pdf->setFilename('Filename Pdf '.$i);
            $pdf->setDescription('Description Pdf '.$i);
            $pdf->setSize(5454);
            $pdf->setOrientation('portrait');
            $pdf->setPagesNumber(422);
            $pdf->setAuthor($author);
            $manager->persist($pdf);

        }
        for($i=1;$i<=3;$i++)
        {
            $video = new Video;
            $video->setFilename('Filename Video '.$i);
            $video->setTitle('Video Name '.$i);
            $video->setDescription('Description Video'.$i);
            $video->setSize(321);
            $video->setFormat('mp3');
            $video->setDuration(60);

            $video->setAuthor($author);
            $manager->persist($video);

        }
        $manager->flush();
    }
}
