<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function details(){
    return  $this->hasOne(InvoiceDetails::class,'id_Invoice');
    }
    public function attachments(){
    return  $this->hasOne(InvoiceAtachment::class);
    }
    public function sections(){
    return  $this->belongsTo(Section::class,'section_id');
    }

}

