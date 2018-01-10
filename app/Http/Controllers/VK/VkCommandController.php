<?php

namespace App\Http\Controllers\VK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VkBot;
use App\Models\Command;
use App\Helpers\ToastrHelper;
use Illuminate\Validation\Rule;

class VkCommandController extends Controller
{
    public function listCommands($id_bot)
    {
        /** @var VkBot $vkBot */
        $vkBot = VkBot::findOrFail($id_bot);
        $commands = $vkBot->commands;

        return view('vk_commands.index', compact('vkBot', 'commands'));
    }


    public function formCommand($id_bot, $id_com = 0)
    {
        $vkBot = VkBot::findOrFail($id_bot);

        switch (\Route::currentRouteName()){
            case 'bots.vk.user_command': $type = 'user';break;
            case 'bots.vk.sys_command':  $type = 'sys'; break;
            case 'bots.vk.bw_command':   $type = 'bw';  break;
            default: $type = '';
        }

        if($id_com)
            $command = Command::where('id', $id_com)->where('type', $type)->first();

        if(empty($command))
            $command = new Command();

        return view('vk_commands.edit', compact('vkBot', 'command', 'type'));
    }


    public function saveCommand(Request $request, ToastrHelper $Toastr, $id_bot, $id_com = 0)
    {
        /** @var VkBot $vkBot */
        $vkBot = VkBot::findOrFail($id_bot);
        /** @var Command $command */
        $command = $id_com ? Command::findOrFail($id_com) : new Command;

        $this->validate($request, $this->getRule($vkBot, $command, $request->get('type')));

        $command->command     = $request->get('command');
        $command->description = $request->get('description');
        $command->message     = $request->get('message');
        $command->error       = $request->get('error');
        $command->enable      = $request->get('enable', false);
        $command->type        = $request->get('type');
        $command->vk_bot_id   = $vkBot->id;
        $command->save();

        $toastrMessage = $id_com
            ? trans('messages.commands.update')
            : trans('messages.commands.create');
        $Toastr->setMessage('', $toastrMessage)->putSessionMessage();

        return redirect()->route('bots.vk.list_command', ['id_bot' => $vkBot->id]);
    }


    public function removeCommand(ToastrHelper $Toastr, $id_com = 0)
    {
        $command = Command::findOrFail($id_com);
        $command->delete();

        $Toastr->setMessage('', trans('messages.commands.delete'))->putSessionMessage();

        return 'Ok';
    }




    private function getRule(VkBot $vkBot, Command $command, $type)
    {
        switch($type){
            case 'user': return [
                'command'     => ['required', 'max:50', 'user_command', Rule::unique('commands')
                    ->where('vk_bot_id', $vkBot->id)
                    ->ignore($command->id)
                ],
                'description' => 'max:250',
                'message'     => 'required',
                'enable'      => 'boolean'
            ];

            case 'sys': return [
                'command' => ['required','max:50','sys_command',Rule::unique('commands')
                    ->where('vk_bot_id', $vkBot->id)
                    ->ignore($command->id)
                ],
                'message' => 'required',
                'enable'  => 'boolean'
            ];

            case 'bw': return [
                'command'     => ['required', Rule::unique('commands')
                    ->where('vk_bot_id', $vkBot->id)
                    ->ignore($command->id)
                ],
                'description' => 'max:250',
                'message'     => 'required',
                'error'       => 'max:250',
                'enable'      => 'boolean'
            ];

            default: return [];
        }
    }

}