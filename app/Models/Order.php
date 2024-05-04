<?php

namespace App\Models;


use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'sub_total',
        'shipping',
        'tax_amount',
        'tax_rate',
        'amount',
        'comment',
        'status',
    ];

    public function customerData(){
        return $this->hasOne(User::class, 'id', 'user_id')->select('id','fname','lname');
    }

    
    public function productData(){
        return $this->hasOne(Product::class, 'id', 'product_id')->select('id','name');
    }

    public function lineItemsData(){
        return $this->hasMany(Lineitem::class, 'order_id', 'id');
    }
}
