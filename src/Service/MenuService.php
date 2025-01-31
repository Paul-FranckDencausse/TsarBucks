<?php
// src/Service/MenuService.php
namespace App\Service;

use App\Repository\MenuRepository;
use App\Repository\SaloonMenuRepository;

class MenuService
{
    private MenuRepository $menuRepository;
    private SaloonMenuRepository $saloonMenuRepository;

    public function __construct(MenuRepository $menuRepository, SaloonMenuRepository $saloonMenuRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->saloonMenuRepository = $saloonMenuRepository;
    }

    public function getAllMenus(): array
    {
        return [
            'menus' => $this->menuRepository->findAll(),
            'specialties' => $this->saloonMenuRepository->findAll(),
        ];
    }
}
