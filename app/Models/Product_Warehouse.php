<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Warehouse extends Model
{
	protected $table = 'product_warehouse';
    protected $fillable =[
        "product_id", "product_batch_id", "variant_id", "imei_number", "warehouse_id", "qty", "price", "actual_unit_cost"
    ];

    public function scopeFindProductWithVariant($query, $product_id, $variant_id, $warehouse_id)
    {
    	return $query->where([
            ['product_id', $product_id],
            ['variant_id', $variant_id],
            ['warehouse_id', $warehouse_id]
        ]);
    }

    public function scopeFindProductWithoutVariant($query, $product_id, $warehouse_id)
    {
    	return $query->where([
            ['product_id', $product_id],
            ['warehouse_id', $warehouse_id]
        ]);
    }
}
