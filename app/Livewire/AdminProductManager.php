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
    public $category_id = null;

    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'url_image' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        Product::create(array_merge($validated, [
            'is_active' => true,
            'discount' => 0,
            'stock'=> $this->stock
        ]));

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
