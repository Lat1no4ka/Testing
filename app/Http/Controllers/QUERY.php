<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use function PHPSTORM_META\type;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
class QUERY extends Controller
{
    public function OK(){ //Контролер запроса к API или к БД
       return view('welcome'); 
    }
    public function GetData(){
        $client = new Client();
        $res = $client->request('GET', 'https://openexchangerates.org/api/latest.json?app_id=acbb4eb0c26f45079e24d4ffc75545c2');
         $array = json_decode($res->getBody()->getContents(), true);
      
       
        return response()->json(array('success' => true, 'data' =>$array));
          
     }
     
}
