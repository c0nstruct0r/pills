<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Товары производителей
 * как родительская сущность для всех товаров
 * @property int id
 * @property bool is_published
 * @property int manufacturer_id
 * @property int brand_id
 * @property string barcode
 * @property string name
 * @property string alias
 * @property int created_at
 * @property int updated_at
 */
class ManufacturerProduct extends Model
{
    use HasFactory;

    public const string TABLE = 'manufacturer_products';
    public const string RELATION_USER_PRODUCT = 'userProduct';
    public const string RELATION_BRAND = 'brand';
    public const string RELATION_MANUFACTURER = 'manufacturer';
    public const string RELATION_CATEGORY = 'category';
    public const string RELATION_PRICES = 'prices';
    public const string RELATION_CART = 'cart';
    public const string RELATION_LIKES = 'likes';
    public const string RELATION_LIKE_SUM = 'likeSum';
    public const string ID = 'id';
    public const string IS_PUBLISHED = 'is_published';
    public const string CATEGORY_ID = 'category_id';
    public const string BARCODE = 'barcode';
    public const string NAME = 'name';
    public const string ALIAS = 'alias';
    public const string MANUFACTURER_ID = 'manufacturer_id';
    public const string BRAND_ID = 'brand_id';
    public const string LIKES = 'likes';
    public const string LIKE = 'like';
    public const string IN_CART = 'in_cart';

    public $timestamps = false;

    protected $fillable = [
        self::MANUFACTURER_ID,
        self::BRAND_ID,
        self::CATEGORY_ID,
    ];
    protected $hidden = [
        self::CREATED_AT,
        self::UPDATED_AT,
    ];
    protected $guarded = [
        self::NAME,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    protected $appends = [
        self::LIKES,
        self::LIKE,
        self::IN_CART,
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function checks(): HasMany
    {
        return $this->hasMany(Check::class, Check::POS_ID, self::ID);
    }

    public function distributorProducts(): hasMany
    {
        return $this->hasMany(DistributorProduct::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly([
            self::NAME,
            self::BARCODE,
        ]);
    }

    public function getLikesAttribute(): int
    {
        return $this->likes()->sum(Like::RATE);
    }

    public function likes(): HasOne
    {
        return $this->hasOne(Like::class, Like::PRODUCT_ID);
    }

    public function getInCartAttribute(): int
    {
        $inCart = $this->cart()->where(Cart::USER_ID, '=', auth()->user()->id)->select(Cart::QUANTITY)->first();

        return $inCart ? $inCart->quantity : 0;
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class, Like::PRODUCT_ID);
    }

    public function getLikeAttribute(): int
    {
        $like = $this->likes()->where(Like::USER_ID, '=', auth()->user()->id)->select(Like::RATE)->first();

        return $like ? $like->rate : 0;
    }

    public function prices(): HasMany
    {
        return $this->hasMany(ProductAggregate::class, ProductAggregate::PRODUCT_ID)
            ->orderBy(ProductAggregate::PRICE_DATE, 'desc');
    }

    public function likeSum(): string
    {
        return $this->hasOne(Like::class, Like::PRODUCT_ID)->sum(Like::ID);
    }

    public function posProducts(): hasMany
    {
        return $this->hasMany(PosProduct::class);
    }

    public function save(array $options = []): bool
    {
        $this->created_at = $this->created_at ?? time();
        $this->updated_at = time();

        if ($this->brand_id) {
            $brand = Brand::where(Brand::ID, '=', $this->brand_id)->first();
            $this->manufacturer_id = $brand->manufacturer_id;
        }


        return parent::save($options);
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function posProduct(): HasMany
    {
        return $this->hasMany(PosProduct::class);
    }

    public function userProduct(): HasMany
    {
        return $this->hasMany(UserProduct::class, UserProduct::PRODUCT_ID);
    }

}
