<?php

namespace Sts\Models;

class Encryption
{

    private string $iv1_tamanho = openssl_cipher_iv_length('aes-256-cbc');
    private string $iv2_tamanho = openssl_cipher_iv_length('aes-128-cbc');
    private string $iv1 = openssl_random_pseudo_bytes($iv1_tamanho);
    private string $iv2 = openssl_random_pseudo_bytes($iv2_tamanho);
    private string $firstKey = base64_decode(FIRSTKEY);
    private string $secondKey = base64_decode(SECONDKEY);
    private string $thirdKey = base64_decode(THIRDKEY);
    
    public function encrypt(string $input): string
    {

        

        return $output
    }

}


?>