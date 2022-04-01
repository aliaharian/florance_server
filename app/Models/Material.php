<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    function pType(){
        $type = $this->type;
        switch ($type){
            case 'cabin':
                return 'کابین';
            case 'surface':
                return 'صفحه';
            case 'bowl':
                return 'کاسه';
            case 'mirror':
                return 'آینه';
            case 'drawer':
                return 'کشو';

        }
    }
}
