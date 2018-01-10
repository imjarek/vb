<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Snippets\VkSnippets;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Command
 *
 * @property int $id
 * @property string $command
 * @property string $keys
 * @property string $message
 * @property string $error
 * @property string $description
 * @property bool $enable
 * @property string $type
 * @property string $snippets
 * @property int $vk_bot_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\VkBot $vk_bot
 * @method static Builder|Command commandsInMessage($message)
 * @method static Builder|Command emptyMessage()
 * @method static Builder|Command firstMessage()
 * @method static Builder|Command isEnable()
 * @method static Builder|Command whereCommand($value)
 * @method static Builder|Command whereCreatedAt($value)
 * @method static Builder|Command whereDescription($value)
 * @method static Builder|Command whereEnable($value)
 * @method static Builder|Command whereId($value)
 * @method static Builder|Command whereKeys($value)
 * @method static Builder|Command whereMessage($value)
 * @method static Builder|Command whereError($value)
 * @method static Builder|Command whereSnippets($value)
 * @method static Builder|Command whereType($value)
 * @method static Builder|Command whereUpdatedAt($value)
 * @method static Builder|Command whereVkBotId($value)
 * @mixin \Eloquent
 */
class Command extends Model
{
    use VkSnippets;

    protected $table    = "commands";
    protected $fillable = ['command', 'message', 'error', 'description', 'enable', 'created_at', 'updated_at', 'vk_bot_id'];
    protected $casts    = ['enable' => 'boolean'];


    /*
     * Scopes
     */
    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsEnable($query)
    {
        $query->where('enable', true);
        return $query;
    }
    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFirstMessage($query)
    {
        $query->where('command', '$first_message');
        return $query;
    }
    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEmptyMessage($query)
    {
        $query->where('command', '$empty_message');
        return $query;
    }
    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $message
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCommandsInMessage($query, $message)
    {
        preg_match("#\/(?:\w|_|-)+#", trim($message), $match);

        if(!empty($match[0])){
            $query->where('command', $match[0]);
        }else{
            $query->where('id', 0);
        }

        return $query;
    }


    /*
     * Relationships
     */
    public function vk_bot()
    {
        return $this->belongsTo('App\Models\VkBot');
    }


    /*
     * Helpers
     */
    public function getUrlEditVk()
    {
        switch($this->type){
            case 'user': return route('bots.vk.user_command', ['id_bot' => $this->vk_bot_id, 'id_com' => $this->id]);
            case 'sys': return route('bots.vk.sys_command', ['id_bot' => $this->vk_bot_id, 'id_com' => $this->id]);
            case 'bw': return route('bots.vk.bw_command', ['id_bot' => $this->vk_bot_id, 'id_com' => $this->id]);
            default: return '#';
        }
    }
    public static function getCommandsWithMessage($message)
    {
        preg_match_all("#\/(?:\w|_|-)+#", trim($message), $match);
        return !empty($match[0]) ? $match[0] : [];
    }
}
