<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Helpers\ToastrHelper;
use App\Helpers\UploadsImageHelper;
use Session;

class ProfileController extends Controller
{
    /**
     * Page profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        return view('profile.index');
    }


    /**
     * Update logo profile
     * @param Request $request
     * @param ToastrHelper $Toastr
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateLogo(Request $request, ToastrHelper $Toastr)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required', 'x' => 'required', 'y' => 'required', 'width' => 'required', 'height' => 'required'
        ]);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator)->withInput();

        }else{

            /** @var \App\Models\User $currentUser */
            $currentUser = $request->user();
            if(UploadsImageHelper::cropUserLogo(
                $currentUser->id,
                $request->input('file'),
                $currentUser->logo,
                (int)$request->input('width', 200),
                (int)$request->input('height', 200),
                (int)$request->input('x', 0),
                (int)$request->input('y', 0)
            )){
                $currentUser->logo = $request->input('file');
                $currentUser->save();
                $Toastr->setMessage('', trans("messages.user.logo.success"))->putSessionMessage();
            }

        }

        return redirect()->back();
    }


    /**
     * Update data profile
     * @param Request $request
     * @param ToastrHelper $Toastr
     * @return mixed
     */
    public function updateProfile(Request $request, ToastrHelper $Toastr)
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = $request->user();

        $validator = Validator::make($request->all(), [
            'first_name'=> 'required|max:50',
            'surname'   => 'required|max:50',
        ]);

        if($validator->fails()){
            $Toastr->setMessage('', trans("messages.form.error"), 'error')->positionTopFullWidth()->putSessionMessage();
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $currentUser->first_name = $request->input('first_name');
        $currentUser->surname    = $request->input('surname');
        $currentUser->save();

        $Toastr->setMessage('', trans('messages.update.profile'))->positionTopFullWidth()->putSessionMessage();

        return redirect()->route('profile');
    }


    /**
     * Change password user
     * @param Request $request
     * @param ToastrHelper $Toastr
     * @return mixed
     */
    public function changePassword(Request $request, ToastrHelper $Toastr)
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = $request->user();
        $newPassword = $request->input('password_old', '');

        $validator = Validator::make($request->all(), [
            'password_old' => 'required|min:4|max:24',
            'password'     => 'required|min:4|max:24|confirmed',
        ]);

        $validator->after(function(\Illuminate\Validation\Validator $validator){
            if(!password_verify($validator->attributes()['password'], \Auth::user()->password)){
                $validator->errors()->add('password_old', trans('auth.failedPass'));
            }
        });

        if($validator->fails()){
            $Toastr->setMessage('', trans("messages.form.error"), 'error')->putSessionMessage();
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $currentUser->password = bcrypt($newPassword);
        $currentUser->de_password = $newPassword;
        $currentUser->save();

        $Toastr->setMessage('', trans('messages.update.password'))->putSessionMessage();

        return redirect()->back();
    }


    // Save status toggle sidebar
    public function sidebarToggle(Request $request)
    {
        if($request->ajax()){
            Session::put('sidebar-toggle', $request->input('sidebar_toggle', ''));
        }
    }
}