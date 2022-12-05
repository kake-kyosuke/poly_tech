<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Todo extends Model
{
    //ソフトデリート、削除日
    use SoftDeletes;
    
    //削除日追加
    protected $dates = ['deleted_at'];
    
    //Laravel側から触ってもよいカラムを指定する
    protected $fillable = ['title', 'content', 'start_date', 'end_date', 'status'];

    //1対多のリレーション追加
    public function user() {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        // 保存時user_idをログインユーザーに設定
        self::saving(function($stock) {
            $stock->user_id = Auth::id();
        });
    }
}

