<?php

if(rand(0,1)===1){
    echo '{"result":"OK","resultCode":1,"id":123}';
}else{
    echo '{"result":"DECLINE","resultCode":555,"resultMessage":"Amount exceed"}';
}
?>
