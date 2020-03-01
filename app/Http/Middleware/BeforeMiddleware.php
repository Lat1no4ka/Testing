<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class BeforeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    public function  handle( $request, Closure $next)
    {   //Запрос к API
        $client = new Client();
        $res = $client->request('GET', 'https://openexchangerates.org/api/latest.json?app_id=acbb4eb0c26f45079e24d4ffc75545c2');
        $array = json_decode($res->getBody()->getContents(), true); 
        $table = DB::select('select * from data where id = 10'); //Проверка состояния БД, и добавление записей раз в 24 часа
        if (!empty($table)) {
            foreach ($table as $data) {
                $btwTime =  $data->date;
              }
                if ((strtotime(date("Y-m-d H:i:s")) - strtotime($btwTime)) > 86400 ){
                    DB::delete('delete from data');
                    $iter = 0;
                    $date = date("Y-m-d H:i:s");
                    foreach ($array['rates'] as $key => $value) {
                        $iter = $iter + 1;
                        $hash = Hash::make($value);
                        DB::insert('insert into data (id, base, value, date) values (?, ?, ?, ?)', [$iter, "$key", "$hash", $date]);
                    }
                }   
        } else {
            $iter = 0;
            $date = date("Y-m-d H:i:s");
            foreach ($array['rates'] as $key => $value) {
                $iter = $iter + 1;
                $hash = Hash::make($value);
                DB::insert('insert into data (id, base, value, date) values (?, ?, ?, ?)', [$iter, "$key", "$hash", $date]);
            }
        }
        return $next($request);
    }
}
