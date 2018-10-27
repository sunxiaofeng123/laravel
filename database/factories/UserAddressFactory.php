<?php
/**
 * 重命名工厂文件之后需要执行 composer dumpautoload，否则会找不到对应的工厂文件。
 * php artisan tinker
 * factory(App\Models\UserAddress::class)->make() 创建工厂实例
 * factory(App\Models\UserAddress::class, 3)->create(['user_id' => 1])
 */
use Faker\Generator as Faker;

$factory->define(App\Models\UserAddress::class, function (Faker $faker) {

    $addresses = [
        ['北京市', '市辖区', '东城区'],
        ['河北省', '石家庄', '长安区'],
        ['江苏省', '南京市', '相城区'],
        ['广东省', '深圳市', '福田区']
    ];

    $address = $faker->randomElement($addresses);

    return [
        //
        'province' => $address[0],
        'city'     => $address[1],
        'district' => $address[2],
        'address'  => sprintf('第%d街道第%d号', $faker->randomNumber(2), $faker->randomNumber(3)),
        'zip'      => $faker->postcode,
        'contact_name'  => $faker->name,
        'contact_phone' => $faker->phoneNumber
    ];
});
