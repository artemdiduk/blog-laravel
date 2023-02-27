<?php
namespace App\Services;

use App\Services\Interfaces\SaveFile;
use Illuminate\Support\Facades\Storage;

class ServicesSaveArticleImg implements SaveFile
{
    public function save($model, $file)
    {
        if ($file) {
            $ex = $file->getClientOriginalExtension();
            $name = uniqid() . '.' . $ex;
            Storage::putFileAs('public/img/posts', $file, $name);
            return  $model->where(['id' => $model->id])->update(['img' => $name]);
        }
    }
}
