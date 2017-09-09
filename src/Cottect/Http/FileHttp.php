<?php
/**
 * Created by PhpStorm.
 * User: BangDinh
 * Date: 8/23/17
 * Time: 11:34
 */

namespace Cottect\Http;

use Cottect\Constants\ConfigConstants;
use Cottect\Constants\Services;
use Phalcon\Config;
use Phalcon\Di;

class FileHttp extends BaseHttp
{

    /** @var Config $config */
    protected $config;

    /**
     * FileHttp constructor.
     */
    public function __construct()
    {
        $this->config = Di::getDefault()->get(Services::CONFIG);
        $this->setServiceConfig($this->config->get(ConfigConstants::SERVICES)['file']);
    }

    /**
     * @param $path
     * @return mixed|null|\Psr\Http\Message\ResponseInterface
     */
    public function uploadFileWithUniqueKeyDownload($path){
        $body = [
            'headers' => [
                'Access-Trusted-Key' => $this->config->get(ConfigConstants::ACCESS_TRUSTED_KEY)
            ],
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => fopen($path, 'r')
                ]
            ]
        ];
        return $this
            ->post($this->serviceConfig['action']['uploader-with-unique-key-download'])
            ->setBody($body)
            ->request(true);
    }
}