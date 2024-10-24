<?php

namespace App\Models;


use App\Models\Behaviors\TimestampBehavior;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int pos_id
 * @property int is_hidden
 * @property int manufacturer_product_id
 * @property int distributor_product_id
 * @property int category_id
 * @property string name
 * @property string barcode
 * @property ManufacturerProduct manufacturerProduct
 * @property int created_at
 * @property int updated_at
 */
class PosProduct extends Model
{
    use HasFactory, TimestampBehavior;

    public const string RELATION_POS = 'pos';
    public const string RELATION_PRODUCT = 'product';

    public const string TABLE = 'pos_products';
    public const string ID = 'id';
    public const string POS_ID = 'pos_id';
    public const string IS_HIDDEN = 'is_hidden';
    public const string MANUFACTURER_PRODUCT_ID = 'manufacturer_product_id';
    public const string DISTRIBUTOR_PRODUCT_ID = 'distributor_product_id';
    public const string CATEGORY_ID = 'category_id';
    public const string NAME = 'name';
    public const string BARCODE = 'barcode';
    public $timestamps = false;

    protected $fillable = [
        self::BARCODE,
        self::MANUFACTURER_PRODUCT_ID,
    ];
    protected $guarded = [
        self::CREATED_AT,
        self::UPDATED_AT,
    ];
    protected $hidden = [
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    public function pos(): BelongsTo
    {
        return $this->belongsTo(Pos::class, self::POS_ID);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ManufacturerProduct::class, self::MANUFACTURER_PRODUCT_ID);
    }

    public function manufacturerProduct(): BelongsTo
    {
        return $this->belongsTo(ManufacturerProduct::class, 'manufacturer_product_id');
    }

}
