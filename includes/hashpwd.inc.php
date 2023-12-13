<?php

$pwdSignup =  "jianhong";

$options = [
    'cost' =>10
];

$hashedPwd = password_hash($pwdSignup,PASSWORD_BCRYPT,$options);

$pwdLogin =  "jianhong";

if(password_verify($pwdLogin, $hashedPwd)){

}
else{

}