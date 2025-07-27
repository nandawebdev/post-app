<?php

namespace App\View\Components\Kategori;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormKategori extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $category_name, $description;
    public function __construct($id = null)
    {
        if($id){
            $category = Category::find($id);
            $this->id = $category->id;
            $this->category_name = $category->category_name;
            $this->description = $category->description;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.kategori.form-kategori');
    }
}
