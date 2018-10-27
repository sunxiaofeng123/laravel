<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// php artisan make:model Models/UserAddress -fm  -fm 参数代表同时生成 factory 工厂文件和 migration 数据库迁移文件
class UserAddress extends Model
{
    //允许批量插入的字段
    protected $fillable = [
        'province',
        'city',
        'district',
        'address',
        'zip',
        'contact_name',
        'contact_phone',
        'last_used_at',
    ];

    protected $dates = ['last_used_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //访问器
    public function getArrayableAttributes()
    {
        return "{$this->province}{$this->city}{$this->district}{$this->address}";
    }


}
