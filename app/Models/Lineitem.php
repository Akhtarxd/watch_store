<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lineitem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    
    protected $table = 'lineitems';

    protected $fillable = [
        'user_id',
        'order_id',
        'product_id',
        'quantity',
        'price',
        'total_price',
    ];

    public function customerData(){
        return $this->hasOne(User::class, 'id', 'user_id')->select('id','fname','lname');
    }
    public function orderData(){
        return $this->hasOne(Order::class, 'id', 'order_id')->select('id','status','shipping');
    }
    public function productData(){
        return $this->hasOne(Product::class, 'id', 'product_id')->select('id','name');
    }
}
