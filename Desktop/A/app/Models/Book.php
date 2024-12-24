<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Maize\Markable\Markable;
use Maize\Markable\Models\Like;

class Book extends Model
{
    use HasFactory;
    use Markable;

    protected static $marks = [
    \Maize\Markable\Models\Favorite::class
];
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

//     public function scopeFilter($query, array $filters)
//     {

//         $query->when(
//             $filters['search'] ?? false,
//             fn($query, $search) =>
//             $query->where(
//                 fn($query) =>
//                 $query->where('Category', 'like', '%' . $search . '%')
//                     ->orWhere('Subcategory', 'like', '%' . $search . '%')
//             )
// //You don't have to check if the Category or Sub actually exist, just use the where method.
//         );
//     }
   
}
