<?php

// namespace App\Http\Livewire;

// use Livewire\Component;
// use App\Models\Category;
// use App\Models\Subcategory;

// class ttttsss extends Component
// {
//     public $category;
//     public $subcategory;
//     public $categories;
//     public $subcategories;

//     public function mount()
//     {
//         $this->categories = Category::all();
//         $this->subcategories = collect();
//     }

//     public function render()
//     {
//         return view('livewire.ttttsss');
//     }

//     public function updatedCategory($category)
//     {
//         $this->subcategories = Subcategory::where('category_id', $category)->get();
//     }
// }
