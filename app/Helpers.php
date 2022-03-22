<?php

function standardHttpResponse($type = "success", $data){
    switch ($type){
        case "error":
            return (object)[
                'result' => 'error',
                'error' => $data
            ];
        case "success":
            if(empty($data)){
                return (object)[
                    'result' => 'success'
                ];
            }else{
                return (object)[
                    'result' => 'success',
                    'data' => $data
                ];
            }
        default:
            return (object)[
                'result' => 'error',
                'error' => "We can't give the answer this time!"
            ];
    }
}
