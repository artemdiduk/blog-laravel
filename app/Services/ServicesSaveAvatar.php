<?php
namespace App\Services;
use App\Services\Interfaces\SaveFile;
use Illuminate\Support\Facades\Storage;

class ServicesSaveAvatar implements SaveFile {
    public function save($model, $file) {
        if($file) {
            $ex = $file->getClientOriginalExtension();
            $name = uniqid() . '.' . $ex;
            Storage::putFileAs('public/img/users', $file, $name);
            return  $model->update(['avatar' => $name]);
        }
    }   
}
