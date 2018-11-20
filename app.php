<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2018/11/20
 * Time: 8:30
 */

require_once __DIR__ . '/core/Lib/Autoload.php';

use Core\Lib\Autoload;

$autoload = new Autoload();

$autoload->register([
    'class' => [
        'Core\\' => __DIR__ . '/core/'
    ] ,
    'file'  => [
        __DIR__ . '/core/Function/base.php' ,
        __DIR__ . '/core/Function/array.php' ,
        __DIR__ . '/core/Function/file.php' ,
        __DIR__ . '/core/Function/number.php' ,
        __DIR__ . '/core/Function/string.php' ,
        __DIR__ . '/core/Function/url.php' ,
        __DIR__ . '/core/Function/time.php'
    ]
]);

use Core\Lib\DBConnection;

$conn = new DBConnection([
    'type' => 'mysql' ,
    'host' => '127.0.0.1' ,
    'name' => 'test' ,
    'user' => 'root' ,
    'prefix' => '' ,
    'password' => '364793' ,
    'persistent' => false ,
    'charset' => 'utf8'
]);

$res = $conn->table('ttt as t')
    ->leftJoin('fuck as a' , 't.id' , '=' , 'a.id')
    ->innerJoin('abc as c' , 't.id' , '=' , 'c.id')
    ->rightJoin('def as d' , 't.id' , '=' , 'd.id')
    ->where('name' , 'like' , '%g%')
    ->in('fuck' , [])
    ->in('cao' , [2 , 4 , 5])
    ->notIn('hello' , [3 , 2 , 4])
    ->notIn('nihao' , [2 , 4 , 5])
    ->whereBetween('user_id' , [10 , 30])
    ->whereNotBetween('name' , 20 , 40)
    ->groupBy('name')
    ->orderBy('id' , 'desc')
    ->orderBy('user_id' , 'asc')
    ->offset(10)
    ->limit(30)
    ->having('sum(name) > 20')
    ->first();

print_r($res);