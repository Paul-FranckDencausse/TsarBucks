<?php

namespace App\Tests\Controller;

use App\Entity\SaloonMenu;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SaloonMenuControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $saloonMenuRepository;
    private string $path = '/saloon/menu/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->saloonMenuRepository = $this->manager->getRepository(SaloonMenu::class);

        foreach ($this->saloonMenuRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('SaloonMenu index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'saloon_menu[saloon_id]' => 'Testing',
            'saloon_menu[menu_id]' => 'Testing',
            'saloon_menu[name]' => 'Testing',
            'saloon_menu[description]' => 'Testing',
            'saloon_menu[MediaId]' => 'Testing',
            'saloon_menu[type]' => 'Testing',
            'saloon_menu[recipeId]' => 'Testing',
            'saloon_menu[price]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->saloonMenuRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new SaloonMenu();
        $fixture->setSaloon_id('My Title');
        $fixture->setMenu_id('My Title');
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setMediaId('My Title');
        $fixture->setType('My Title');
        $fixture->setRecipeId('My Title');
        $fixture->setPrice('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('SaloonMenu');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new SaloonMenu();
        $fixture->setSaloon_id('Value');
        $fixture->setMenu_id('Value');
        $fixture->setName('Value');
        $fixture->setDescription('Value');
        $fixture->setMediaId('Value');
        $fixture->setType('Value');
        $fixture->setRecipeId('Value');
        $fixture->setPrice('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'saloon_menu[saloon_id]' => 'Something New',
            'saloon_menu[menu_id]' => 'Something New',
            'saloon_menu[name]' => 'Something New',
            'saloon_menu[description]' => 'Something New',
            'saloon_menu[MediaId]' => 'Something New',
            'saloon_menu[type]' => 'Something New',
            'saloon_menu[recipeId]' => 'Something New',
            'saloon_menu[price]' => 'Something New',
        ]);

        self::assertResponseRedirects('/saloon/menu/');

        $fixture = $this->saloonMenuRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getSaloon_id());
        self::assertSame('Something New', $fixture[0]->getMenu_id());
        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getMediaId());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getRecipeId());
        self::assertSame('Something New', $fixture[0]->getPrice());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new SaloonMenu();
        $fixture->setSaloon_id('Value');
        $fixture->setMenu_id('Value');
        $fixture->setName('Value');
        $fixture->setDescription('Value');
        $fixture->setMediaId('Value');
        $fixture->setType('Value');
        $fixture->setRecipeId('Value');
        $fixture->setPrice('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/saloon/menu/');
        self::assertSame(0, $this->saloonMenuRepository->count([]));
    }
}
