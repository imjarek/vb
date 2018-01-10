<?php

namespace App\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Auth;
use App\Models\User;
use App\Models\VkBot;

class MainSidebarComposer
{
    protected $vars = [];

    public function compose(View $view)
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        if($currentUser->hasRole('admin')){
            $this->vars = array_merge($this->vars, $this->getCountNewUsers());
            $this->vars = array_merge($this->vars, $this->getCountVkBotsInTrash());
        }

        $view->with('VC_MainSidebar', $this->collectionsArray());
    }



    private function getCountNewUsers()
    {
        return [
            'countUsersNew' => User::whereStatus(0)->count()
        ];
    }

    private function getCountVkBotsInTrash()
    {
        return [
            'countVkTrash' => VkBot::onlyTrashed()->count()
        ];
    }

    private function collectionsArray()
    {
        return Collection::make($this->vars);
    }
}
