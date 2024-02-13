<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $guarded=[];
    
   public function product()
   {

    return $this->hasMany(product::class,'section_id');

   }
    public function sections()
   {

    return $this->hasMany(Section::class,'section_id');

   }

}
