<?php


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property int category_id
 * @property string name
 * @property int created_at
 * @property int updated_at
 */
class Category extends Model
{
    use HasFactory, TimestampBehavior;


    public const string RELATION_CATEGORY = 'category';
    public const string RELATION_CATEGORIES = 'categorys';
    public const string RELATION_PRODUCTS = 'products';
    public const string TABLE = 'categories';

    public const string ID = 'id';
    public const string CATEGORY_ID = 'category_id';
    public const string NAME = 'name';
    public $timestamps = false;

    protected $fillable = [
        self::NAME,
        self::CATEGORY_ID,

    ];
    protected $guarded = [
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function categorys(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(\App\Models\ManufacturerProduct::class);
    }

}
