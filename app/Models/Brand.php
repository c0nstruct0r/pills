<?php

namespace App\Models;

use App\Models\Behaviors\TimestampBehavior;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
* @property int id
* @property int manufacturer_id
* @property string name
* @property string alias
* @property string address
* @property string url
* @property int created_at
* @property int updated_at
 */

class Brand extends Model
{
    use HasFactory,TimestampBehavior;

    public const string TABLE = 'brands';
    public const string CACHE_KEY = 'BRAND_CACHE_KEY';

    public const string ID = 'id';
    public const string MANUFACTURER_ID = 'manufacturer_id';
    public const string NAME = 'name';
    public const string ALIAS = 'alias';
    public const string URL = 'url';

    protected $fillable = [
        self::NAME,
        self::URL,
    ];

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function manufacturerProducts(): hasMany
    {
        return $this->hasMany(ManufacturerProduct::class);
    }
}
