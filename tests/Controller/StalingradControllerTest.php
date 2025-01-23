<?php

namespace App\Tests\Controller;

use App\Entity\Stalingrad;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class StalingradControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $stalingradRepository;
    private string $path = '/manager/stalingrad/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->stalingradRepository = $this->manager->getRepository(Stalingrad::class);

        foreach ($this->stalingradRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Stalingrad index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'stalingrad[Name]' => 'Testing',
            'stalingrad[Media]' => 'Testing',
            'stalingrad[address]' => 'Testing',
            'stalingrad[phone]' => 'Testing',
            'stalingrad[openingHours]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->stalingradRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Stalingrad();
        $fixture->setName('My Title');
        $fixture->setMedia('My Title');
        $fixture->setAddress('My Title');
        $fixture->setPhone('My Title');
        $fixture->setOpeningHours('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Stalingrad');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Stalingrad();
        $fixture->setName('Value');
        $fixture->setMedia('Value');
        $fixture->setAddress('Value');
        $fixture->setPhone('Value');
        $fixture->setOpeningHours('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'stalingrad[Name]' => 'Something New',
            'stalingrad[Media]' => 'Something New',
            'stalingrad[address]' => 'Something New',
            'stalingrad[phone]' => 'Something New',
            'stalingrad[openingHours]' => 'Something New',
        ]);

        self::assertResponseRedirects('/manager/stalingrad/');

        $fixture = $this->stalingradRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getMedia());
        self::assertSame('Something New', $fixture[0]->getAddress());
        self::assertSame('Something New', $fixture[0]->getPhone());
        self::assertSame('Something New', $fixture[0]->getOpeningHours());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Stalingrad();
        $fixture->setName('Value');
        $fixture->setMedia('Value');
        $fixture->setAddress('Value');
        $fixture->setPhone('Value');
        $fixture->setOpeningHours('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/manager/stalingrad/');
        self::assertSame(0, $this->stalingradRepository->count([]));
    }
}
