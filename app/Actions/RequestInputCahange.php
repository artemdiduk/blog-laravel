<?php

namespace App\Actions;

class RequestInputCahange
{
    public function updateRequestInputText($dataUpdate, $dataInfo, $infoUpdate)
    {
        if ($dataInfo) {
            $dataUpdate->update($infoUpdate);
        }
    }
    public function toArticle($group, $post) {
        return redirect("$group->slag/$post->slag")->with('status', 'Post created!');
    }
}
