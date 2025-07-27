<?php

namespace App\View\Components\Product;

use App\Models\Category;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormProduct extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $product_name, $sku, $purchase_price, $product_purchase_price, $stock, $minimum_stock, $is_active, $category_id, $category;
    public function __construct($id = null)
    {
        $this->category = Category::all();
        if($id){
            $product = Product::find($id);
            $this->id = $product->id;
            $this->product_name = $product->product_name;
            $this->purchase_price = $product->purchase_price;
            $this->product_purchase_price = $product->product_purchase_price;
            $this->stock = $product->stock;
            $this->minimum_stock = $product->minimum_stock;
            $this->is_active = $product->is_active;
            $this->category_id = $product->category_id;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product.form-product');
    }
}
