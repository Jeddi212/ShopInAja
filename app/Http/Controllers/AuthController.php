<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function signUp()  
    {  
        return view('auth.signUp');
    }

    public function ajaxPassword()
    {
        return view('auth.ajax.cekPassword');
    }
    public function ajaxUsername()
    {
        return view('auth.ajax.cekUsername');
    }

    public function register(Request $request)
    {
        $keys= $request->keys;
        $values= $request->values;
        $accountId = self::getAccountId();

        $data = array();
        $data+=array('name' => ucwords($request->get('name')));
        $data+=array('username' => $request->get('username'));
        $data+=array('gender' => $request->get('gender'));
        $data+=array('email' => $request->get('email'));
        $data+=array('password' => $request->get('password'));
        $i=0;

        if(self::newAccount($accountId, $data))
        {
            return redirect()->route('index');
        }
    }
    static function getAccountId()  
    {  
        if(!Redis::exists('account_count')) {
            Redis::set('account_count',0);
        }
        
        return Redis::incr('account_count');  
    }  

    static function newAccount($accountId, $data) : bool  
    {  
        self::addToAccounts($accountId);  
    
        return Redis::hMset("account:$accountId", $data);  
    }  

    static function addToAccounts($accountId) : void  
    {  
        Redis::zAdd('accounts', time(), $accountId);  
    } 

    public function logIn()  
    {  
        return view('auth.logIn');
    }

    static function getAccounts($start = 0, $end = -1) : array  
    {  
        $accountIds = Redis::zRange('accounts', $start, $end, true);  
        $accounts = [];  
    
        foreach ($accountIds as $accountId => $score) 
        {  
            $accounts[$score]= Redis::hGetAll("account:$accountId");  
        } 

        return $accounts;
    }

    static function loginAuthenticate(Request $request)
    {
        // $credentials = $request->validate([
        //     'username' => 'required',
        //     'password' => 'required'
        // ]);

        $data = array();
        $data+=array('username' => $request->get('username'));
        $data+=array('password' => $request->get('password'));

        $cek=false;
        $accounts = self::getAccounts();
        foreach($accounts as $value){
            if($data["username"] == $value["username"] && $data["password"] == $value["password"]){
                $cek=true;
            }
        }
        
        if($cek==true){

            $request->session()->regenerate();

            return redirect()->intended('/products/all');

        }

        return back()->with('loginError', 'Login Failed!');

    }

    public function logout()
    {
        // Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
