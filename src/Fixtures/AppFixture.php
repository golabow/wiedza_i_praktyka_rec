<?php


namespace App\Fixtures;


use App\Entity\Developer;
use App\Entity\Position;
use App\Entity\Product;
use App\Entity\ProjectManager;
use App\Entity\Tester;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $pt = new Position();
        $pt->setName('tester');
        $manager->persist($pt);

        $pd = new Position();
        $pd->setName('developer');
        $manager->persist($pd);

        $pp = new Position();
        $pp->setName('project manager');
        $manager->persist($pp);

        $ut = new Tester();
        $ut->setFirstName('asdas');
        $ut->setLastName('asdas');
        $ut->setEmail('est@asdsa.pl');
        $ut->setPosition($pt);
        $ut->setTestSystems('test');
        $ut->setReportSystems('test');
        $manager->persist($ut);

        $ud = new Developer();
        $ud->setFirstName('asdas');
        $ud->setLastName('asdas');
        $ud->setEmail('est@asdsa.pl');
        $ud->setPosition($pd);
        $ud->setIdeEnvironments('test');
        $ud->setProgramingLanguages('sql');
        $manager->persist($ud);

        $up = new ProjectManager();
        $up->setFirstName('asdas');
        $up->setLastName('asdas');
        $up->setEmail('est@asdsa.pl');
        $up->setPosition($pp);
        $up->setProjectMethodology('test');
        $up->setReportSystems('sql');
        $manager->persist($up);

        $manager->flush();
    }
}