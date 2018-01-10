<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\ToastrHelper;
use App\Helpers\UploadsImageHelper;

class UsersController extends Controller
{
    const COUNT_USERS_ON_PAGE = 15;
    const LOGO_PATH = 'uploads/user_logo/';


    public function allUsers(Request $request)
    {
        return $this->showTableUsers($request, false, trans('content.users.title.all'));
    }

    public function newUsers(Request $request)
    {
        $users = User::whereStatus(0);
        return $this->showTableUsers($request, $users, trans('content.users.title.new'));
    }

    public function activeUsers(Request $request)
    {
        $users = User::whereStatus(1);
        return $this->showTableUsers($request, $users, trans('content.users.title.active'));
    }

    public function blockedUsers(Request $request)
    {
        $users = User::whereStatus(2);
        return $this->showTableUsers($request, $users, trans('content.users.title.blocked'));
    }

    public function adminUsers(Request $request)
    {
        $users = User::whereRole('admin');
        return $this->showTableUsers($request, $users, trans('content.users.title.admin'));
    }

    public function updateUser(Request $request, ToastrHelper $Toastr)
    {
        $id_user = $request->get('id_user', 0);
        $action  = $request->get('action', '');

        /** @var User $selectedUser */
        if($selectedUser = User::find($id_user)){
            switch($action){
                case 'setUser': $selectedUser->role = 'user';break;
                case 'setAdmin': $selectedUser->role = 'admin'; break;
                case 'setActive': $selectedUser->status = 1; break;
                case 'setBlocked': $selectedUser->status = 2; break;
            }

            if($action === 'remove'){
                $Toastr->setMessage('', trans('messages.users.remove', ['fio' => $selectedUser->fio(false)]))->putSessionMessage();
                UploadsImageHelper::removeUserLogo($selectedUser->logo);
                $selectedUser->delete();
            }else{
                $Toastr->setMessage('', trans('messages.users.update', ['fio' => $selectedUser->fio(false)]))->putSessionMessage();
                $selectedUser->save();
            }
        };

        return 'Ok';
    }

    private function showTableUsers(Request $request, $queryUsers, $headerTitle = '')
    {
        /** @var \App\Models\User  $queryUsers */
        $searchInput = $request->get('search_user', '');
        $users = ($queryUsers)
            ? $queryUsers->formSearch($searchInput)->paginate(self::COUNT_USERS_ON_PAGE)
            : User::formSearch($searchInput)->paginate(self::COUNT_USERS_ON_PAGE);

        return view('users.index', compact('users', 'headerTitle', 'searchInput'));
    }


}