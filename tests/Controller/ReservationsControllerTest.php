<?php

namespace App\Tests\Controller;

use App\Entity\Reservations;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ReservationsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/admin/reservations/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Reservations::class);

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
        self::assertPageTitleContains('Reservation index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'reservation[user_id]' => 'Testing',
            'reservation[saloon_id]' => 'Testing',
            'reservation[date]' => 'Testing',
            'reservation[people]' => 'Testing',
            'reservation[status]' => 'Testing',
            'reservation[activity_id]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservations();
        $fixture->setUser_id('My Title');
        $fixture->setSaloon_id('My Title');
        $fixture->setDate('My Title');
        $fixture->setPeople('My Title');
        $fixture->setStatus('My Title');
        $fixture->setActivity_id('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Reservation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservations();
        $fixture->setUser_id('Value');
        $fixture->setSaloon_id('Value');
        $fixture->setDate('Value');
        $fixture->setPeople('Value');
        $fixture->setStatus('Value');
        $fixture->setActivity_id('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'reservation[user_id]' => 'Something New',
            'reservation[saloon_id]' => 'Something New',
            'reservation[date]' => 'Something New',
            'reservation[people]' => 'Something New',
            'reservation[status]' => 'Something New',
            'reservation[activity_id]' => 'Something New',
        ]);

        self::assertResponseRedirects('/admin/reservations/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getUser_id());
        self::assertSame('Something New', $fixture[0]->getSaloon_id());
        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getPeople());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getActivity_id());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservations();
        $fixture->setUser_id('Value');
        $fixture->setSaloon_id('Value');
        $fixture->setDate('Value');
        $fixture->setPeople('Value');
        $fixture->setStatus('Value');
        $fixture->setActivity_id('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/admin/reservations/');
        self::assertSame(0, $this->repository->count([]));
    }
}
