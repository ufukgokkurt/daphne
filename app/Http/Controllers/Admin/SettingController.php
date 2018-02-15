<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin;
use Sentinel;
use Setting;
use Illuminate\Support\Facades\Config;

class SettingController extends AdminController
{

/** Genel Ayarlar */

    public function getGeneral() {
        if (!Sentinel::getUser()->hasAccess('setting.general')) { // Yetki kontolü
            return $this->show_403();
        }

        $setting = Setting::all();

        return view('backend.setting.general',compact('setting'));

    }


    public function postGeneral(Request $request) {
        if (!Sentinel::getUser()->hasAccess('setting.general')) {
            return $this->show_403();
        }
        $veri = $request->except(['_token', '_method']);


        foreach ($veri as $key => $value) {
            Setting::set($key, $value);
        }
        Setting::save();

            return redirect(route('setting.general'))->with(['success'=>'Genel ayarlar başarıyla güncellendi.']);

    }



   /** Mail Ayarları */

public function getSmtp() {
    if (!Sentinel::getUser()->hasAccess('setting.smtp')) { // Yetki kontolü
        return $this->show_403();
    }

    $smtp=Config::get('mail');
    return view('backend.setting.smtp',compact('smtp'));

}

    public function postSmtp(Request $request) {
        if (!Sentinel::getUser()->hasAccess('setting.smtp')) {
            return $this->show_403();
        }
        $env_update = $this->changeEnv([
            'MAIL_HOST'=>$request->mail_host,
            'MAIL_PORT'=>$request->mail_port,
            'MAIL_USERNAME'=>$request->mail_user,
            'MAIL_PASSWORD'=>$request->mail_pass,
            'MAIL_ENCRYPTION'=>$request->mail_enc,
            'MAIL_FROM_ADDRESS'=>$request->mail_from_adres,
            'MAIL_FROM_NAME'=>$request->mail_from_user,
            'MAIL_ADMIN'=>$request->mail_admin
        ]);
        if($env_update){
            return redirect(route('setting.smtp'))->with(['success'=>'SMTP bilgileri başarıyla güncellendi.']);
        } else {
            return redirect(route('setting.smtp'))->with(['error'=>'SMTP bilgileri güncellenemedi.']);

        }
    }



    protected function changeEnv($data = array()){
        if(count($data) > 0){

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = explode("\n", $env);

            // Loop through given data
            foreach((array)$data as $key => $value){

                // Loop through .env-data
                foreach($env as $env_key => $env_value){

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . '="'.$value.'"';
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;
        } else {
            return false;
        }
    }
}
