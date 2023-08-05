<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = [];

    protected $casts  = ['area' => 'array' , 'delivery_method_type' => 'array'];

    public function delivery(){
        return $this -> belongsTo(Delivery::class);
    }

    public function admin(){
        return $this -> belongsTo(Admin::class);
    }

    public function deliverymethod(){
        return $this -> belongsTo(deliverymethod::class);
    }


}
