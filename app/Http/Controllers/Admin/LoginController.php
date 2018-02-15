<?php

namespace App\Http\Controllers\Admin;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Activation;


class LoginController extends AdminController
{
    public  function login() {
      return view('backend.login.login');

    }

    public  function  postLogin(Request $request) {

       $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|min:5'
        ]);
        if ($validator->fails()) {
            return redirect(route('admin.login'))->withErrors($validator);
        }
try {
    if (Sentinel::authenticate($request->all())) {


        if (Sentinel::getUser()->hasAccess('admin.dashboard')) {
            return redirect(route('admin.home'));
        }else{
            Sentinel::logout();
            return redirect(route('admin.login'))->with(["error" => "Bu bölüme erişim hakkınız yok."]);
        }


    } else {
        return redirect()->back()->with(["error" => "Bilgileriniz hatalı."]);
    }

}catch(ThrottlingException $e) {
    $delay=$e->getDelay();
    return redirect()->back()->with(["error" => "Hatalı girişlerden dolayı  $delay saniye banlandınız."]);

} catch (NotActivatedException $e) {
    return redirect()->back()->with(["error" => "Hesabınız aktif edilmemiş."]);
}


    }

    public function logout() {
        Sentinel::logout();
        return redirect(route('admin.login'));

    }

}
