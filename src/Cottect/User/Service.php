<?php

namespace Cottect\User;

use Cottect\Constants\AclRoles;

use Cottect\Constants\ConfigConstants;
use Cottect\Constants\HeaderConstants;
use Cottect\Constants\Services;
use Cottect\Http\UserHttp;
use Phalcon\Di;
use Phalcon\Mvc\Model;
use PhalconApi\User\Service as PhalconApiService;

class Service extends PhalconApiService
{
    /**
     * @return string
     */
    public function getRole()
    {
        $userModel = $this->getDetails();

        $role = AclRoles::UNAUTHORIZED;
        $headers = $this->request->getHeaders();
        /**
         * Check Headers has accessTrustedKey and accessTrustedKey match the accessTrustedKey at config
         * This is private service request
         * AclRoles is a LOCAL_SERVICE
         */
        $key = HeaderConstants::ACCESS_TRUSTED_KEY;
        if (empty($userModel) && array_key_exists($key, $headers)) {
            $config = Di::getDefault()->get(Services::CONFIG);
            $accessTrustedKey = $config->get(ConfigConstants::ACCESS_TRUSTED_KEY);
            if (!empty($headers[$key]) && ($accessTrustedKey === $headers[$key])) {
                $role = AclRoles::LOCAL_SERVICE;
            }
        }
        if(is_object($userModel)){
            /** @var Model $userModel */
            $userModel = $userModel->toArray();
        }
        if (!empty($userModel) && in_array(ucfirst(strtolower($userModel['role'])), AclRoles::ALL_ROLES)) {
            $role = ucfirst(strtolower($userModel['role']));
        }
        return $role;
    }

    /**
     * @param mixed $identity
     * @return array
     */
    protected function getDetailsForIdentity($identity)
    {
        $details = [];
        $token = $this->authManager->getSession()->getToken();
        $userHttp = new UserHttp();
        $myUser = $userHttp->getUserInformationWithToken($token);
        if (isset($myUser['data']['item']) && $myUser['data']['item']['id'] > 0) {
            $details = $myUser['data']['item'];
        }
        return $details;
    }

    /**
     * @return mixed
     */
    public function getTickets()
    {
        $user = $this->getDetails();
        return $user['tickets'];
    }

    /**
     * @param string $domainName
     * @param string $controllerName
     * @param string $actionName
     * @return bool
     */
    public function allowRbacPermission($domainName, $controllerName, $actionName)
    {
        $userRole = $this->getRole();
        if ($userRole == AclRoles::ADMINISTRATOR) {
            return true;
        } else {
            $resource = $domainName . '.' . $controllerName . '.' . $actionName;
            $tickets = $this->getTickets();
            return in_array($resource, $tickets);
        }
    }

}