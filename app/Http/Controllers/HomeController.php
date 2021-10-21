<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $req){
        $user = $req->session()->get('user');
        if($user){
            return redirect('welcome');
        } else {
            return view('home.login');
        }
    }

    public function welcome(Request $req){
        $user = $req->session()->get('user');
        if($user){
            return view('home.welcome');
        } else {
            return redirect('/');
        }
        
    }

    public function registration(Request $req){
        $user = $req->session()->get('user');
        if($user){
            return redirect('welcome');
        } else {
            return view('home.registration');
        }
    }

    public function verification(Request $req){
        $registeredUser = $req->session()->get('registeredUser');
        if($registeredUser){
            return view('home.verification');
        }else{
            return redirect('registration');
        }
        
    }

    public function userLogin(Request $req){
        $req->validate([
            'username' => 'required|email',
            'password' => 'required|min:8'
        ]);
        $data = $req->input();

        $payload = [
            'username' => $data['username'],
            'password' => $data['password']
        ];
        
        $result = json_decode($this->postApi($payload, "https://api.baseplate.appetiserdev.tech/api/v1/auth/login"));
        
        if($result->http_status == '200'){
            $req->session()->flash('SuccessMessage', "Login successful!");
            $req->session()->put('user', $data['username']);
            return redirect('welcome');
        }else if($result->http_status == '401'){
            $req->session()->flash('ErrorMessage', $result->message);
            return redirect('/');
        }else{
            $req->session()->flash('ErrorMessage', "Internal Server Error");
            return redirect('/');
        }
    }

    public function userLogout(){
        if(session()->has('user')){
            session()->pull('user');
        }
        return redirect('/');
    }

    public function register(Request $req){
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'repeatPassword' => 'required|min:8|same:password'
        ]);

        $data = $req->input();

        $payload = [
            'email' => $data['email']
        ];

        $checkEmail = json_decode($this->postApi($payload, "https://api.baseplate.appetiserdev.tech/api/v1/auth/check-email"));
        if($checkEmail->http_status == '200'){
            $req->session()->flash('ErrorMessage', "User already exist.");
            return redirect('registration');
        }else{
            $payload = [
                'email' => $data['email'],
                'full_name'=> $data['fullname'],
                'password'=> $data['password'],
                'password_confirmation' => $data['repeatPassword']
            ];
            $registerUser = json_decode($this->postApi($payload, "https://api.baseplate.appetiserdev.tech/api/v1/auth/register"));
            if($registerUser->http_status == '200'){
                $req->session()->put('registeredUser', $data['email']);
                $req->session()->put('registeredUserToken', $registerUser->data->access_token);
                return redirect('verification');
            }else{
                $req->session()->flash('ErrorMessage', $registerUser->message);
                return redirect('registration');
            }
            
        }
    }

    public function verify(Request $req){
        $req->validate([
            'verifyCode' => 'required|min:5|max:5'
        ]);
        $data = $req->input();
        
        $payload = [
            "token"=> $data["verifyCode"],
            "via"=> "email"
        ];
        $userToken = $req->session()->get('registeredUserToken');
        $verifyUser = json_decode($this->postApiWithToken($payload, "https://api.baseplate.appetiserdev.tech/api/v1/auth/verification/verify", $userToken));
        if($verifyUser->http_status == '200'){
            session()->pull('registeredUser');
            session()->pull('registeredUserToken');
            return redirect('/');
        }else{
            $errMessage = "";
            if($verifyUser->http_status){
                $errMessage = $verifyUser->message;
            }else{
                $errMessage = "Internal Server Error";
            }
            $req->session()->flash('ErrorMessage', $errMessage);
            return redirect('verification');
        }
    }

    public function postApi($payload, $apiUrl){
        $apiRequest = Http::asForm()->post($apiUrl, $payload);
        return $apiRequest;
    }

    public function postApiWithToken($payload, $apiUrl, $userToken){
        $apiRequest = Http::withHeaders([
            'Accept' => 'application/json'
        ])->withToken($userToken)->post($apiUrl, $payload);
        return $apiRequest;
    }
}
