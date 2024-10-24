<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
* @property int id
* @property string name
* @property string alias
* @property string address
* @property string url
* @property int created_at
* @property int updated_at
 */

class Manufacturer extends Model
{
    use HasFactory;

    public const string TABLE = 'manufacturers';

    public const string ID = 'id';
    public const string NAME = 'name';
    public const string ALIAS = 'alias';
    public const string ADDRESS = 'address';
    public const string URL = 'url';

    protected $fillable = [
        self::NAME,
        self::ADDRESS,
        self::ADDRESS,
        self::URL,
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy(self::NAME, 'asc');
        });
    }

    public function manufacturerProducts(): hasMany
    {
        return $this->hasMany(ManufacturerProduct::class);
    }

}
