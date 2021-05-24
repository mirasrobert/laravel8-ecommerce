<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductReview extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $product;
    public $reviews;
    public $hasReview;
    public $canReview;

    public function __construct($product, $reviews, $hasReview, $canReview)
    {
        $this->product = $product;
        $this->reviews = $reviews;
        $this->hasReview = $hasReview;
        $this->canReview = $canReview;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-review');
    }
}
