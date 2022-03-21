<?php

namespace App\Helpers;

class DBTypes {
    static function get($type){
        switch($type) {
            case 'identification_type':
                return ['CPF'];
        }
    }
}