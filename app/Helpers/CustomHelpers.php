<?php
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

function checkVal($val){
    if($val){
        return $val;
    }
    return "N/A";
}
function checkDateVal($val){
    if($val){
        return date('d-m-Y',strtotime($val));
    }
    return "N/A";
}
function setting(){
    $query = DB::table('settings')->first();
    return $query;
}
function travelList(){
    $query = DB::table('travels')->get();
    return $query;
}
function checkLink($link){
    if($link){
        return $link;
    }
    return "#";
}
function generateQr($link)
{
    return QRCode::size(300)->generate($link);
}