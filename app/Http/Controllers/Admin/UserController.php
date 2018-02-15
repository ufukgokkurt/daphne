<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;
use Validator;
use Activation;
class UserController extends AdminController
{

    /** Controller oluşturulmadan middleware ile kullanıcının izinleri kontrol ediliyor */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Sentinel::getUser()->hasAccess('user.user')) {
                return $this->show_403();
            }
            return $next($request);
        });
    }




    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'first_name' => 'required|min:2|max:35|string', // Ad Soyad beraber alınıyor
            //'last_name' => 'required|min:2|max:35|string',
            'email' => 'required|email|min:3|max:50|unique:users|string',
            'password' => 'min:6|max:15|confirmed',
            //'gender' => 'required',
            'role' => 'required',
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        return view('backend.user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get()->pluck('name', 'id');
        return view('backend.user.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->validator($request)->fails()) {

            return redirect()->back()
                ->withErrors($this->validator($request))
                ->withInput();
        }


        //create user
        $user = Sentinel::register($request->all());
        //activate user
        $activation = Activation::create($user);
        $activation = Activation::complete($user, $activation->code);
        //add role
        $user->roles()->sync([$request->role]);
        return redirect(route('user.index'))->with(['success' => 'Kullanıcı başarıyla oluşturuldu.']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::get()->pluck('name', 'id');
        return View('backend.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_user = Validator::make($request->all(), [
            'first_name' => 'min:2|max:35|string',
            // 'last_name' => 'min:2|max:35|string',
            'email' => (Sentinel::check() ? 'required|email|min:3|max:50|string|unique:users,email,' . $id : 'required|email|min:3|max:50|unique:users|string'),
        ]);
        if ($update_user->fails()) {
            return redirect()->back()
                ->withErrors($update_user)
                ->withInput();
        }


        $user = User::find($id);
        if ($user) {
            if ($request->first_name) {
                $user->first_name = $request->first_name;
            }
            if ($request->last_name) {
                $user->last_name = $request->last_name;
            }
            if ($request->email) {
                $user->email = $request->email;
            }
            if ($request->new_password && $request->new_password_confirmation) {
                if ($request->new_password == $request->new_password_confirmation) {
                    $user->password = bcrypt($request->new_password);
                } else {

                    return redirect()->back()->withErrors(['error', 'Şifreler uyuşmuyor']);

                }
            }
            $user->update();
            if ($request->role) {
                $user->roles()->sync([$request->role]);
            }
            return redirect(route('user.index'))->with(['success' => 'Kullanıcı başarıyla güncellendi.']);

        }
        return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id!=Sentinel::getUser()->id) {

            $user->delete();

            return redirect(route('user.index'))->with(['success' => 'Kullanıcı başarıyla silindi.']);
        }else{
            return redirect(route('user.index'))->with(['success' => 'Kendi hesabınızı silemezsiniz.']);
        }
    }


 /** Kullanıcı aktif ediliyor */
    public function activate(Request $request,$id)
    {
        $user = Sentinel::findById($id);
        if(Activation::completed($user)){
            return redirect(route('user.index'))->with(['error' => 'Kullanıcı zaten aktif.']);
        }else{
           $activation= Activation::exists($user);
            if(!$activation) {
                $activation = Activation::create($user);
            }

           Activation::complete($user, $activation->code);
        }


        return redirect(route('user.index'))->with(['success' => 'Kullanıcı aktif edildi.']);
    }


    /** Kullanıcı pasif ediliyor  */
    public function deactivate(Request $request,$id){
        $user = Sentinel::findById($id);
        if ($user->id!=Sentinel::getUser()->id) {
            Activation::remove($user);
            return redirect(route('user.index'))->with(['success' => 'Kullanıcı  pasif edildi.']);
        }else{
            return redirect(route('user.index'))->with(['error' => 'Kendi hesabınızı pasif edemezsiniz.']);
        }

    }

    /** Ajax ile toplu işlem */
    public function ajax_all(Request $request){
        if ($request->action=='delete') {
            foreach ($request->all_id as $id) {
                $user = User::findOrFail($id);
                if ($user->deleted_at == null){$user->delete();}
            }

            return response()->json(['success' => true, 'status' => 'Başarıyla silindi.']);
        }
        if ($request->action=='deactivate') {
            foreach ($request->all_id as $id) {
                $user = User::findOrFail($id);
                $activation = Activation::completed($user);
                if ($activation){Activation::remove($user);}
            }

            return response()->json(['success' => true, 'status' => 'Başarıyla pasif edildi.']);
        }
        if ($request->action=='activate') {
            foreach ($request->all_id as $id) {
                $user = User::findOrFail($id);
                $activation = Activation::completed($user);
                if ($activation==''){
                    $activation = Activation::create($user);
                    $activation = Activation::complete($user, $activation->code);
                }
            }

            return response()->json(['success' => true, 'status' => 'Başarıyla aktif edildi.']);
        }
    }
}
