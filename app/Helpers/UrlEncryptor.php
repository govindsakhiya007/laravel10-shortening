<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;

/**
 * Class UrlEncryptor
 * 
 * A helper class for encrypting and decrypting URLs.
 */
class UrlEncryptor
{
    /**
     * Encrypt the given URL.
     *
     * This method takes a URL string, encrypts it using Laravel's Crypt facade,
     * and then encodes it for safe inclusion in URLs.
     *
     * @param string $url The URL to be encrypted.
     * @return string The encrypted and URL-encoded string.
     */
    public static function encrypt($url)
    {
        return urlencode(Crypt::encryptString($url));
    }

    /**
     * Decrypt the given encrypted URL.
     *
     * This method takes an encrypted and URL-encoded string, decodes it,
     * and then decrypts it using Laravel's Crypt facade to return the original URL.
     *
     * @param string $encryptedUrl The encrypted and URL-encoded string.
     * @return string The decrypted URL.
     */
    public static function decrypt($encryptedUrl)
    {
        return Crypt::decryptString(urldecode($encryptedUrl));
    }
}
