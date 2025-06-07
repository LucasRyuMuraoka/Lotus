<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class MenuSection extends Component
{

    public string $filter = 'todos';
    public string $search = '';

    public function setFilter(string $category)
    {
        $this->filter = $category;
    }

    public function getItemsProperty()
    {
        $query = Product::with('category');

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        } elseif ($this->filter !== 'todos') {
            $query->whereHas('category', fn($q) => $q->where('name', $this->filter));
        }

        return $query->get();
    }

    public function render()
    {

        //$items = Product::with('category');

        //if ($this->filter !== 'todos') {
        //    $items->whereHas('category', function ($query) {
        //        $query->where('name', $this->filter);
        //    });
        //}

        return view('livewire.menu-section', [
            'items' => $this->getItemsProperty(),
        ]);
    }
}
