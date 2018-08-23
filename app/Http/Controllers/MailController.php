<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Exception;
use App\TestMongo;
use App\Mail\SendMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class MailController extends Controller
{
    public function testMongo()
    {
        $data = request()->all();
        $mon = new TestMongo();
        return response()->json($mon->testMongo($data));
    }

    public function sendMail()
    {
        Mail::send('emails.welcome', [], function($message) {
            $to = request()->all();
            $message->to($to['email'], 'Nitesh')
                    ->subject('Test Mail');
        });

        return "Email sent successfully.";
    }

    public function cache()
    {
        Cache::put('cachekey', 'I am in the cache.', 1);
	
        if( Cache::has( 'cachekey' ) ) {
            return Cache::get( 'cachekey' );
        } else {
            return 'cachekey was forgotten, so this is just random data';
        }

        return Cache::get( 'cachekey', 'cache expires' );        
    }

    public function createAccount()
    {
        try {
            $data = request()->all();
            $user = new User();                        
            $response = ['error' => 0, 'data' => $user->createAccount($data) ];            

        } catch (Exception $ex) {
            $response = ['error' => 1, 'message' => $ex->getMessage()];
        }

        return response()->json($response);
    }
    
}
