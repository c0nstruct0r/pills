<?php

namespace App\Models;

use App\Models\Behaviors\TimestampBehavior;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * товаров поставщика
 * @property int id
 * @property int parent_id
 * @property string barcode
 * @property string name
 * @property string address
 * @property string price
 * @property int distributor_id
 * @property int manufacturer_product_id
 * @property ManufacturerProduct manufacturerProduct
 * @property int created_at
 * @property int updated_at
 */
class DistributorProduct extends Model
{
    use HasFactory, TimestampBehavior;

    public const string TABLE = 'distributor_products';
    public const string ID = 'id';
    public const string BARCODE = 'barcode';
    public const string NAME = 'name';
    public const string DISTRIBUTOR_ID = 'distributor_id';
    public const string PRICE = 'price';
    public const string MANUFACTURER_PRODUCT_ID = 'manufacturer_product_id';

    public $timestamps = false;

    protected $fillable = [
        self::MANUFACTURER_PRODUCT_ID,
    ];
    protected $guarded = [
        self::NAME,
        self::DISTRIBUTOR_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    public function manufacturerProduct()
    {
        return $this->belongsTo(ManufacturerProduct::class, 'manufacturer_product_id');
    }

}
