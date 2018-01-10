<?php

namespace App\Http\Controllers\VK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VkBot;
use App\Models\Command;
use Validator;
use App\Helpers\ToastrHelper;
use Illuminate\Validation\Rule;
use App\SocialApi\VkApi;

class VkBotController extends Controller
{
    /**
     * Main page for bot
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $vkBots = VkBot::all();
        return view('vk_bots.index', compact('vkBots'));
    }


    /**
     * Form create bot
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('vk_bots.edit');
    }


    /**
     * Form edit bot
     * @param $id_bot
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id_bot)
    {
        $vkBot = VkBot::findOrFail($id_bot);
        return view('vk_bots.edit', compact('vkBot'));
    }


    /**
     * Create or update bot
     * @param Request $request
     * @param ToastrHelper $Toastr
     * @param int $id_bot
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, ToastrHelper $Toastr, $id_bot = 0)
    {
        if($fields = $request->all()){
            $fields['enable'] = isset($fields['enable']);
        };

        $validator = Validator::make($fields, [
            'name'         => 'required|max:50',
            'description'  => 'max:250',
            'id_group'     => ['required', 'integer', Rule::unique('vk_bots')->ignore($id_bot)],
            'vk_key'       => ['required', 'max:250', Rule::unique('vk_bots')->ignore($id_bot)],
            'secret_key'   => 'max:250',
            'response_api' => 'required|max:100',
            'widget'       => 'max:5000',
            'enable'       => 'boolean'
        ]);

        $validator->after(function($validator) {
            /** @var \Illuminate\Validation\Validator $validator */
            $fields = $validator->getData();

            if ($fields['enable']) {
                $vkApi = new VkApi($fields);
                $vkDialogs = $vkApi->messagesGetDialogs();

                if($vkDialogs['error']){
                    $Toastr = new ToastrHelper();
                    $Toastr->setMessage('VK api', "code: {$vkDialogs['code']}<br>error: {$vkDialogs['error']}", 'error');
                    $Toastr->putSessionMessage();

                    $validator->errors()->add('enable', trans('validation.vk_api.connect'));
                }
            }
        });

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id_bot
            ? VkBot::find($id_bot)->update($fields)
            : VkBot::create($fields);

        $Toastr->setMessage('', trans('messages.vk_bot.update', ['name' => $fields['name']]))->putSessionMessage();

        return redirect()->route('bots.vk');
    }


    /**
     * Test page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function test($id)
    {
        /** @var VkBot $vkBot */
        $vkBot = VkBot::findOrFail($id);
        $commands = Command::whereVkBotId($vkBot->id)->isEnable()->orderBy('command')->get();

        return view('vk_bots.test', compact('vkBot', 'commands'));
    }


    /**
     * Remove bot in trash
     * @param ToastrHelper $Toastr
     * @param $id
     * @return string
     */
    public function removeInTrash(ToastrHelper $Toastr, $id)
    {
        /** @var VkBot $vkBot */
        $vkBot = VkBot::findOrFail($id);
        $nameBot = $vkBot->name;
        $vkBot->delete();
        $Toastr->setMessage('', trans('messages.vk_bot.delete', ['name' => $nameBot]))->putSessionMessage();

        return 'Ok';
    }


    /**
     * Get bots in trash
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash(Request $request)
    {
        abort_if(!$request->user()->hasRole('admin'), 403);

        $vkBots = VkBot::onlyTrashed()->get();

        return view('vk_bots.trash', compact('vkBots'));
    }


    /**
     * AJAX - Restore bot
     * @param ToastrHelper $Toastr
     * @param $id
     * @return string
     */
    public function restore(ToastrHelper $Toastr, $id)
    {
        /** @var VkBot $vkBot */
        $vkBot = VkBot::onlyTrashed()->where('id', $id)->first();

        abort_if(!$vkBot, 404);

        $vkBot->restore();
        $Toastr->setMessage('', trans('messages.vk_bot.restore', ['name' => $vkBot->name]))->putSessionMessage();

        return 'Ok';
    }


    /**
     * AJAX - Remove with trash
     * @param ToastrHelper $Toastr
     * @param $id
     * @return string
     */
    public function removeWithTrash(ToastrHelper $Toastr, $id)
    {
        /** @var VkBot $vkBot */
        $vkBot = VkBot::onlyTrashed()->where('id', $id)->first();

        abort_if(!$vkBot, 404);

        $nameBot = $vkBot->name;
        $vkBot->forceDelete();
        $Toastr->setMessage('', trans('messages.vk_bot.force_delete', ['name' => $nameBot]))->putSessionMessage();

        return 'Ok';
    }

}