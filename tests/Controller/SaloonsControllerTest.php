<?php

namespace App\Tests\Controller;

use App\Entity\Saloons;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SaloonsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/admin/saloons/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Saloons::class);

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
        self::assertPageTitleContains('Saloon index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'saloon[name]' => 'Testing',
            'saloon[address]' => 'Testing',
            'saloon[number]' => 'Testing',
            'saloon[email]' => 'Testing',
            'saloon[opening_hours]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Saloons();
        $fixture->setName('My Title');
        $fixture->setAddress('My Title');
        $fixture->setNumber('My Title');
        $fixture->setEmail('My Title');
        $fixture->setOpening_hours('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Saloon');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Saloons();
        $fixture->setName('Value');
        $fixture->setAddress('Value');
        $fixture->setNumber('Value');
        $fixture->setEmail('Value');
        $fixture->setOpening_hours('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'saloon[name]' => 'Something New',
            'saloon[address]' => 'Something New',
            'saloon[number]' => 'Something New',
            'saloon[email]' => 'Something New',
            'saloon[opening_hours]' => 'Something New',
        ]);

        self::assertResponseRedirects('/admin/saloons/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getAddress());
        self::assertSame('Something New', $fixture[0]->getNumber());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getOpening_hours());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Saloons();
        $fixture->setName('Value');
        $fixture->setAddress('Value');
        $fixture->setNumber('Value');
        $fixture->setEmail('Value');
        $fixture->setOpening_hours('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/admin/saloons/');
        self::assertSame(0, $this->repository->count([]));
    }
}
