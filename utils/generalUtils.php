<?php
/**
 * Created by PhpStorm.
 * User: elizabeth
 * Date: 2018-04-16
 * Time: 9:11 PM
 */

class GeneralUtils
{
    public static function generateUniqueID() : string {
        return uniqid();
    }

    public static function hashPassword($password) : string {
        return password_hash($password, PASSWORD_BCRYPT, array(
           'cost' => 12
        ));
    }

    public static function isValidPassword($password, $storedPassword) :bool {
        return password_verify($password, $storedPassword);
    }
}