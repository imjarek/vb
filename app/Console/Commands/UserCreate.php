<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Validator;

class UserCreate extends Command
{
    protected $signature = 'user:create';
    protected $description = 'Create user for application';



    protected $User;
    protected $listStatus = [0 => 'new', 1 => 'active', 2 => 'blocked'];
    protected $listRoles = ['user', 'admin'];
    protected $userData = [
        'first_name'           => '',
        'surname'              => '',
        'email'                => '',
        'password'             => '',
        'password_confirmation'=> '',
        'de_password'          => '',
        'status'               => '',
        'role'                 => '',
        'api_token'            => '',
    ];



    public function __construct()
    {
        parent::__construct();
        $this->User = new User();
    }



    public function handle()
    {
        $locale = $this->choice('Язык/Language', [0 => 'English', 1 => 'Русский'], 0);
        \App::setLocale(str_replace(['English', 'Русский'], ['en', 'ru'], $locale));

        while(!$this->userData['first_name']){
            $this->userData['first_name'] = $this->ask(trans('form.label.first_name'));
            $this->validateField('first_name');
        }

        while(!$this->userData['surname']){
            $this->userData['surname'] = $this->ask(trans('form.label.surname'));
            $this->validateField('surname');
        }

        while(!$this->userData['email']){
            $this->userData['email'] = $this->ask(trans('form.label.email'));
            $this->validateField('email');
        }

        while(!$this->userData['password']){
            $this->userData['password'] = $this->secret(trans('form.label.password'));
            $this->userData['password_confirmation'] = $this->secret(trans('form.label.password_confirmation'));
            $this->userData['de_password'] = $this->userData['password'];
            $this->validateField('password');
        }

        while($this->userData['status'] === ''){
            $this->userData['status'] = $this->choice(trans('user.status.title'), $this->listStatus, 0);
            $this->userData['status'] = array_search($this->userData['status'], $this->listStatus);
        }

        while($this->userData['role'] === ''){
            $this->userData['role'] = $this->choice(trans('user.role.title'), $this->listRoles, 0);
        }

        User::create($this->userData);

        $this->info(trans('messages.user.console.create'));
    }



    private function validateField($field)
    {
        switch ($field){
            case 'first_name':
                $rules = [$field => 'required|string|max:50'];
                break;
            case 'surname':
                $rules = [$field => 'required|string|max:50'];
                break;
            case 'email':
                $rules = [$field => 'required|string|email|max:100|unique:users'];
                break;
            case 'password':
                $rules = [$field => 'required|string|min:4|max:24|confirmed'];
                break;
            default: $rules = [];
        }

        $v = Validator::make($this->userData, $rules);
        if($v->fails()){
            $this->error($v->getMessageBag()->getMessages()[$field][0]);
            $this->userData[$field] = '';
        }
    }

}
