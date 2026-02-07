<?php

namespace Ngankt2\VNLocation\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class VnLocation
 *
 * @property int $id
 * @property string $name
 * @property string|null $full_name
 * @property string|null $full_path
 * @property string $code
 * @property string|null level
 * @property string|null $parent_code
 * @property VNLocation|null $parent
 * @property \Illuminate\Database\Eloquent\Collection|VNLocation[] $children
 */
class VNLocation extends Model
{

    protected $table = 'vn_locations';

    protected $primaryKey = 'code';

    protected $keyType = 'string';


    /**
     * Parent location.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_code', 'code');
    }

    /**
     * Child locations.
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_code', 'code');
    }

    /**
     * Alias: children of a province (wards/communes).
     */
    public function wards(): HasMany
    {
        return $this->children();
    }

    /**
     * Provinces / cities (root).
     */
    public function scopeProvinces(Builder $query): Builder
    {
        return $query->whereNull('parent_code');
    }

    /**
     * Wards/communes (non-root).
     */
    public function scopeWards(Builder $query): Builder
    {
        return $query->whereNotNull('parent_code');
    }

    public static function getProvince()
    {
        return self::query()->provinces()->get();
    }

    public static function getWardsByProvinceCode(string $code)
    {
        return self::query()->wards()->where('parent_code', $code)->get();
    }
}
