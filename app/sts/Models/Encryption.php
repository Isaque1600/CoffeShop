<?php

namespace Sts\Models;

class Encryption
{
    private string $iv1Size;
    private string $iv2Size;
    private string $firstKey;
    private string $secondKey;
    private string $thirdKey;

    /**
     * Criptografa um entrada
     * @param string $input texto a ser criptografado
     * @return string entrada criptografada
     */
    public function encrypt(string $input)
    {
        $this->setIv1Size();
        $this->setIv2Size();
        $this->setFirstKey();
        $this->setSecondKey();
        $this->setThirdKey();

        $iv1 = openssl_random_pseudo_bytes($this->iv1Size);
        $iv2 = openssl_random_pseudo_bytes($this->iv2Size);

        $firstEncrypt = openssl_encrypt($input, 'aes-256-cbc', $this->firstKey, OPENSSL_RAW_DATA, $iv1);
        $secondEncrypt = openssl_encrypt($firstEncrypt, 'aes-128-cbc', $this->secondKey, OPENSSL_RAW_DATA, $iv2);
        $thirdEncrypt = hash_hmac('sha3-512', $secondEncrypt, $this->thirdKey, true);

        $output = $iv1 . $iv2 . $thirdEncrypt . $secondEncrypt;

        return base64_encode($output);
    }

    /**
     * Descriptografa um entrada
     * @param string $input texto criptografado
     * @return string texto descriptografado
     */
    public function decrypt(string $input)
    {
        $this->setIv1Size();
        $this->setIv2Size();
        $this->setFirstKey();
        $this->setSecondKey();
        $this->setThirdKey();

        $mix = base64_decode($input);

        $iv1 = substr($mix, 0, $this->iv1Size);
        $iv2 = substr($mix, $this->iv1Size, $this->iv2Size);
        $secondEncrypt = substr($mix, -32);
        $thirdEncrypt = substr($mix, 32, 64);

        $firstEncrypt = openssl_decrypt($secondEncrypt, 'aes-128-cbc', $this->secondKey, OPENSSL_RAW_DATA, $iv2);
        $data = openssl_decrypt($firstEncrypt, 'aes-256-cbc', $this->firstKey, OPENSSL_RAW_DATA, $iv1);
        $thirdEncryptNew = hash_hmac('sha3-512', $secondEncrypt, $this->thirdKey, true);

        if (hash_equals($thirdEncrypt, $thirdEncryptNew)) {
            return $data;
        }

        return "error";
    }


    /**
     * Seta a primeira chave
     * @return void
     */
    public function setFirstKey(): void
    {
        $this->firstKey = base64_decode(FIRSTKEY);
    }

    /**
     * Seta a segunda chave
     * @return void
     */
    public function setSecondKey(): void
    {

        $this->secondKey = base64_decode(SECONDKEY);
    }

    /**
     * Seta a terceira chave
     * @return void
     */
    public function setThirdKey(): void
    {

        $this->thirdKey = base64_decode(THIRDKEY);
    }

    /** 
     * Seta a iv (chave de inicialização de cifra) da primeira criptografia
     * @return void
     */
    public function setIv1Size(): void
    {
        $this->iv1Size = openssl_cipher_iv_length('aes-256-cbc');
    }

    /**
     * Seta a iv (chave de inicialização de cifra) da segunda criptografia 
     * @return void
     */
    public function setIv2Size(): void
    {
        $this->iv2Size = openssl_cipher_iv_length('aes-128-cbc');
    }
}


?>