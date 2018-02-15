<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Sentinel;

class RoleController extends AdminController
{
    /** Controller oluşturulmadan middleware ile kullanıcının izinleri kontrol ediliyor */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Sentinel::getUser()->hasAccess('user.role')) {
                return $this->show_403();
            }
            return $next($request);
        });
    }


    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|max:35|min:2|string',
        ] );
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::all();
       return view('backend.role.index')->with('roles',$roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->validator($request)->fails()) {
            return redirect()->back()
                ->withErrors($this->validator($request))
                ->withInput();
        }
       // $request->request->add(['slug'=>str_slug($request->name)]);
        $role=Role::create($request->all());
        $role->permissions = [];
        if($request->permissions){
            foreach ($request->permissions as $permission) {
             $role->addPermission($permission);

            }
        }
        $role->save();

        return redirect(route('role.index'))->with(['success'=>'Rol başarıyla oluşturuldu.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $role = Role::findOrFail($id);

       return view('backend.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->validator($request)->fails()) {
            return redirect()->back()
                ->withErrors($this->validator($request))
                ->withInput();
        }

      //  $request->request->add(['slug'=>str_slug($request->name)]);

        if (($id!=1) && ($id!=2)) { // Admin ve User Rolleri güncellenemez
            $role = Role::findOrFail($id);
            $role->update($request->all());

            $role->permissions = [];
            if ($request->permissions) {
                foreach ($request->permissions as $permission) {
                    $role->addPermission($permission);

                }
            }
            $role->save();
        }

        return redirect(route('role.index'))->with(['success'=>'Rol başarıyla güncellendi.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (($id!=1) && ($id!=2)) { // Admin ve User Rolleri silinemez
            $role = Role::findOrFail($id);
            $role->delete();
        }
        return redirect(route('role.index'))->with(['success'=>'Rol başarıyla silindi.']);


    }
}
