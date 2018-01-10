<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\VkBot
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $id_group
 * @property string $vk_key
 * @property string $secret_key
 * @property string $response_api
 * @property bool $enable
 * @property string $widget
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Command[] $commands
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot isEnable()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot whereEnable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot whereIdGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot whereResponseApi($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot whereSecretKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot whereVkKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot whereWidget($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VkBot withTrashed()
 * @mixin \Eloquent
 */
class VkBot extends Model
{
    use SoftDeletes;

    protected $table    = "vk_bots";
    protected $fillable = ['name', 'description', 'id_group', 'vk_key', 'secret_key', 'response_api', 'enable', 'widget', 'created_at', 'updated_at','deleted_at'];
    protected $casts    = ['enable' => 'boolean'];
    public static $sysCommands = ['first_message', 'empty_message'];


    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsEnable($query)
    {
        $query->where('enable', true);
        return $query;
    }

    /*
     * Relationships
     */
    public function commands()
    {
        return $this->hasMany(Command::class);
    }

}
