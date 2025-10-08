<?php
namespace Ngankt2\VNLocation\Models;

use Illuminate\Database\Eloquent\Model;
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
     * Get the parent location of this location.
     *
     */
    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(VnLocation::class, 'parent_code', 'code');
    }

    /**
     * Get the child locations of this location.
     *
     */
    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VnLocation::class, 'parent_code', 'code');
    }
}
