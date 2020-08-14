<?php

 function showStatus($status){

    return $status ?  'Shown' : 'Hidden';

}

function classStatus($status){

    // if($status){
    //     dd($status);
    // }
    // dd($status);
    return $status ?  'text-primary' : 'text-danger';

}
function checkStatus($status){
    return $status ? ' checked ' : '';
}