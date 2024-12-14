<?php

namespace App\Tests\Controller;

use App\Entity\Activities;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ActivitiesControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/activities/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Activities::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Activity index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'activity[association_id]' => 'Testing',
            'activity[media_id]' => 'Testing',
            'activity[type]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Activities();
        $fixture->setAssociation_id('My Title');
        $fixture->setMedia_id('My Title');
        $fixture->setType('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Activity');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Activities();
        $fixture->setAssociation_id('Value');
        $fixture->setMedia_id('Value');
        $fixture->setType('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'activity[association_id]' => 'Something New',
            'activity[media_id]' => 'Something New',
            'activity[type]' => 'Something New',
        ]);

        self::assertResponseRedirects('/activities/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getAssociation_id());
        self::assertSame('Something New', $fixture[0]->getMedia_id());
        self::assertSame('Something New', $fixture[0]->getType());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Activities();
        $fixture->setAssociation_id('Value');
        $fixture->setMedia_id('Value');
        $fixture->setType('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/activities/');
        self::assertSame(0, $this->repository->count([]));
    }
}
