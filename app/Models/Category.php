<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}
