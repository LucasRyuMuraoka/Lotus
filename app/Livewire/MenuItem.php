<?php

namespace App\Livewire;

use Livewire\Component;

class MenuItem extends Component
{

    public $productId;
    public $name;
    public $description;
    public $price;
    public $category;
    public $url_image;

    public function render()
    {
        return view('livewire.menu-item');
    }
}
