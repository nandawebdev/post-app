<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Aside extends Component
{
    public $routes;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->routes = [
            [
                'label' => 'Dashboard',
                'icon' => 'fas fa-laptop',
                'route_name' => 'dashboard',
                'route_active' => 'dashboard',
                'is_dropdown' => false,
            ],
            [
                'label' => 'Master Data',
                'icon' => 'fas fa-database',
                'route_active' => 'master-data.*',
                'is_dropdown' => true,
                'dropdown' => [
                    [
                        'label' => 'Kategori',
                        'route_active' => 'master-data.category.*',
                        'route_name' => 'master-data.category.index',
                    ],
                    [
                        'label' => 'Produk',
                        'route_active' => 'master-data.category.*',
                        'route_name' => 'master-data.category.index',
                    ]
                ]

            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.aside');
    }
}
