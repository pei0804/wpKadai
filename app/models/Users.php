<?php

use Slimvc\Base\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $fillable = ['us_mail', 'us_name', 'us_password',];

    public function reports()
    {
        return $this->hasMany('Reports');
    }

    protected static function rules()
    {
        return [
            'us_mail'     => ['required', 'email'],
            'us_name'     => ['required', 'string'],
            'us_password' => ['required', 'string'],
        ];
    }
}