<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BwUser
 * @property int $id
 * @property int $vk_user_id
 * @property int $bw_user_id
 * @property string $token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BwUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BwUser whereVkUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BwUser whereBwUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BwUser whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BwUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BwUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BwUser extends Model
{
    protected $fillable = ['vk_user_id', 'bw_user_id', 'token', 'created_at', 'updated_at'];
}
