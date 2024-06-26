<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function recipent(){
        return $this->belongsTo(User::class,'recipent_id');
    }
    
    static function sendNotiAdmin($id,$type){
        Notification::create([
            'user_id'=> 1,
            'noti_type' => $type,
            'is_read'=> false,
            'recipent_id'=> $id
        ]);
    }
}
