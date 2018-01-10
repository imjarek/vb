<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Helpers\UploadsImageHelper;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $surname
 * @property string $logo
 * @property string $email
 * @property string $password
 * @property string $de_password
 * @property int $status
 * @property string $role
 * @property string $api_token
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User formSearch($input_search)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereApiToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLogo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereSurname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['first_name', 'surname', 'logo', 'email', 'password', 'status', 'role', 'api_token', 'de_password'];
    protected $hidden = ['password', 'remember_token'];
    protected $listStatus = [
        0 => ['name' => 'новый',       'color' => 'warning'],
        1 => ['name' => 'активный',    'color' => 'success'],
        2 => ['name' => 'заблокирован','color' => 'danger']
    ];



    /*
     * Mutators GET
     */
    public function getFirstNameAttribute($value)
    {
        return str_name($value);
    }
    public function getSurnameAttribute($value)
    {
        return str_name($value);
    }
    public function getDePasswordAttribute($value)
    {
        return decrypt($value);
    }

    /*
     * Mutators SET
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = str_name($value);
    }
    public function setSurnameAttribute($value)
    {
        $this->attributes['surname'] = str_name($value);
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function setDePasswordAttribute($value)
    {
        $this->attributes['de_password'] = encrypt($value);
    }
    public function setApiTokenAttribute($value)
    {
        $value = $value ? (string)$value : str_random(20);
        $value .= time();
        $this->attributes['api_token'] = md5($value);
    }



    /*
     * Scopes
     */
    /**
     * Scope for Search
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $input_search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFormSearch($query, $input_search)
    {
        if($input_search && $arr_search = explode(' ', $input_search)){
            $query->orWhereIn('first_name', $arr_search);
            $query->orWhereIn('surname', $arr_search);
            $query->orWhereIn('email', $arr_search);
        }

        return $query;
    }



    /*
     * Helpers
     */
    public function hasRole($role)
    {
        switch($this->role){
            case 'user':
                return in_array($role, ['user']);
            case 'admin':
                return in_array($role, ['user', 'admin']);
            default:
                return false;
        }
    }
    public function roleStr()
    {
        return trans("user.role.{$this->role}");
    }
    public function roleColor()
    {
        return $this->role === 'user' ? 'info' : 'danger';
    }

    public function fio($short = true)
    {
        return ((bool)$short)
            ? "{$this->surname} " . str_first_char($this->first_name) . "."
            : "{$this->surname} {$this->first_name}";
    }

    public function statusStr()
    {
        return trans("user.status.{$this->status}");
    }
    public function statusColor()
    {
        switch($this->status){
            case 0: return 'warning';
            case 1: return 'success';
            case 2: return 'danger';
            default: return '';
        }
    }

    public function urlLogo()
    {
        return UploadsImageHelper::getUserLogo($this->logo, 'img/user.png');
    }
}
