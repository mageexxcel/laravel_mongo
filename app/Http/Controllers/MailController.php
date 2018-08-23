<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Exception;
use App\TestMongo;
use App\Mail\SendMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Snowfire\Beautymail\Beautymail;

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
        Mail::send([], [], function ($message) {
            $message->to('nitesh_kumar@excellencetechnologies.in')
                    ->subject('Test Mail')
                    ->setBody('Hi, how are you');
        });

        return "Email sent.";
    }

    public function index()
    {
        Cache::put('cachekey', 'I am in the cache.', 1);
	
        if( Cache::has( 'cachekey' ) ) {
            return Cache::get( 'cachekey' );
        } else {
            return 'cachekey was forgotten, so this is just random data';
        }

        return Cache::get( 'cachekey', 'cache expires' );        
    }

    public function sendHtmlMail()
    {
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.welcome', [], function($message)
        {
            $to = request()->all();
            $message
                ->to($to['email'], 'Nitesh')
                ->subject('Welcome!');
        });
        
        return "Email Sent.";
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
