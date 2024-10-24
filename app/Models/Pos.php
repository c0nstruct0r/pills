<?php

namespace App\Models;

use App\Models\Behaviors\TimestampBehavior;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int parent_id
 * @property string alias
 * @property string name
 * @property string address
 * @property int created_at
 * @property int updated_at
 */
class Pos extends Model
{
    use HasFactory, TimestampBehavior;

    public const string TABLE = 'pos';
    public const string ID = 'id';
    public const string PARENT_ID = 'parent_id';
    public const string ALIAS = 'alias';
    public const string NAME = 'name';
    public const string ADDRESS = 'address';
    public $timestamps = false;

    protected $fillable = [
        self::ALIAS,
    ];

    protected $hidden = [
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    protected $guarded = [
        self::CREATED_AT,
        self::UPDATED_AT,
    ];


    public function pos(): BelongsTo
    {
        return $this->belongsTo(Pos::class, Pos::ID, self::PARENT_ID);
    }

}
