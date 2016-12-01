<?php
###########################################################################
# CLOUD SERVER API DOCUMENTATION
#
# Name: cloneServer
# Language: PHP
#
# Description: creates a server based on another server specified
###########################################################################

#ID access to API
$TOKEN = "f8a09371ec0f3348ce6d79b4d28c0660"; # e.g.: "f03c3c76cc853ee690b879909c9c6f2a"
$url = "https://cloudpanel-api.1and1.com/v1";

function cloneServer($id, $data){
        global $url;
        global $TOKEN;
        $_command = $url . "/servers/$id/clone";
        $request = curl_init();

        //Set options
        curl_setopt($request, CURLOPT_URL, $_command);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_HTTPHEADER, array("X-TOKEN:$TOKEN", "Content-type:application/json"));
        curl_setopt($request, CURLOPT_CUSTOMREQUEST, "POST");

        //Add parameters
        curl_setopt($request, CURLOPT_POSTFIELDS, $data);


        //Try to get the response
        $response = curl_exec($request);
        if ($response == false){
                return( curl_error($request));
        }
        else{
                return( $response);
        }

        curl_close($request);
}

#PARAMETERS
$id = "C4DFF41647BB127AD33155598C4D951F"; # e.g.: "5340033E7FBBC308BC329414A0DF3C20"
$name = $_SERVER['QUERY_STRING'];


$data = array('name' => $name);
$data = json_encode($data);

echo cloneServer($id, $data);
?>
