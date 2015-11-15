<?php

namespace common\helpers;

class EncryptHelper
{

    private $td = null;

    private $iv = null;

    private $ks = null;

    private $key = null;

    /**
     * 实例化类库
     *
     * @param string $secret_key 加密的安全码
     *
     * @return void
     */
    public function __construct($secret_key)
    {
        $this->td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_ECB, '');
        $this->iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($this->td), MCRYPT_DEV_RANDOM);
        $this->ks = mcrypt_enc_get_key_size($this->td);
        $this->key = substr(md5($secret_key), 0, $this->ks);
    }

    /**
     * 对字符串进行加密
     *
     * @param string $string 要加密的字符串
     *
     * @return string
     */
    public function encode($string)
    {
        mcrypt_generic_init($this->td, $this->key, $this->iv);
        $data = base64_encode(mcrypt_generic($this->td, $string));
        mcrypt_generic_deinit($this->td);
        return $data;
    }

    /**
     * 要解密的字符串
     *
     * @param string $string 需要解密的字符
     * 
     * @return string
     */
    public function decode($string)
    {
        mcrypt_generic_init($this->td, $this->key, $this->iv);
        $data = mdecrypt_generic($this->td, base64_decode($string));
        mcrypt_generic_deinit($this->td);
        return trim($data);
    }

    /**
     * 析构函数
     *
     * @return void
     */
    public function __destruct()
    {
        if (is_resource($this->td)) {
            mcrypt_module_close($this->td);
        }
        $this->td = null;
        $this->iv = null;
        $this->ks = null;
        $this->key = null;
    }
}
