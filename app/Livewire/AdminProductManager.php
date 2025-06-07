<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class AdminProductManager extends Component
{

    public string $name = '';
    public string $description = '';
    public float $price = 0;
    public int $stock = 100;
    public string $url_image = '';
    public int $category_id = 0;

    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function save()
    {
        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'url_image' => $this->url_image,
            'category_id' => $this->category_id,
            'is_active' => true,
            'discount' => 0
        ]);

        $this->reset(['name', 'description', 'price', 'stock', 'url_image', 'category_id']);
        session()->flash('message', 'Produto adicionado com sucesso!');
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();

        session()->flash('message', 'Produto excluído com sucesso!');
    }

    public function render()
    {
        return view('livewire.admin-product-manager', [
            'products' => Product::latest()->get(),
        ]);
    }
}
