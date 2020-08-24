<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PDFCount extends Model
{
    //
    public static function addTrack($user_id){
        $rows = self::query()->where("user_id", $user_id)->get()->toArray();
        $pdfCound = null;
        $count = 0;
        if (sizeof($rows) > 0)
        {
            $id = $rows[0]['id'];
            $pdfCound = self::find($id);
            $count = $pdfCound->count ?? 0;
        } else {
            $pdfCound = new PDFCount;
        }
        $pdfCound->user_id = $user_id;
        $pdfCound->count = $count + 1;
        $pdfCound->save();
    }

    public static function isPossible(){
        $is_subscribed = Auth::user()->is_subscribed;
        if ($is_subscribed != 1)
        {
            $rows = self::query()->where("user_id", Auth::user()->id)->get()->toArray();
            $count = 0;
            if (sizeof($rows) > 0)
            {
                $id = $rows[0]['id'];
                $pdfCound = self::find($id);
                $count = $pdfCound->count ?? 0;
            }
            if ($count > 5)
                return false;
        }
        return true;
    }
}
