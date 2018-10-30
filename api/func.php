<?php

class func
{
    public function response($statusCode, $statusText, $body)
    {
        $array = [
            "status code"=>$statusCode,
            "status text"=>$statusText,
            "body"=>$body
            ];
        echo json_encode(array(("response") => $array));
    }

}