<?php

namespace Cottect\Auth;

use Cottect\Http\UserHttp;

use PhalconApi\Auth\AccountType;

class UsernameAccountType implements AccountType
{
    const NAME = 'username';


    /**
     * It is not necessary to log in from another service to the user service because it has already been authenticated by the token
     * @param array $data
     * @return string|void
     */
    public function login($data)
    {

    }

    /**
     * @param string $token
     * @return bool
     */
    public function authenticate($token)
    {
        $useHttp = new UserHttp();
        $userData = $useHttp->getUserInformationWithToken($token);
        if(
            ($userData['statusCode'] == 200)
            && isset($userData['data']['item'])
            && ($userData['data']['item']['id'] > 0)
        ){
            return true;
        }
        return false;
    }
}