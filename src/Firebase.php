<?php

namespace Deigon\SDK;

class Firebase{

    protected $color;
    private $fcm_key;

    /**
     * @param String $fcm_key
     * @param String $color
     * @return bool|string
     */
    public function __construct(String $fcm_key, String $color = '#669966'){
        $this->fcm_key = $fcm_key;
        $this->color = $color;
    }

    
    /**
     * @param String $fireToken
     * @param String $title
     * @param String $body
     * @return bool|string
     */
    public function sendCloudMessage(String $fireToken, String $title, String $body){
        $data = [
            "to" => $fireToken,
            "notification" => [
                "title" => $title,
                "body" => $body,
                "color"=> $this->color
            ]
        ];


        return $this->sendFMC($data);
    }


    /**
     * @param array $fireTokens
     * @param String $title
     * @param String $body
     * @return bool|string
     */
    public function sendMultipleCloudMessage(Array $fireTokens, String $title, String $body){
        $data = [
            "registration_ids" => $fireTokens,
            "notification" => [
                "title" => $title,
                "body" => $body,
                "color"=> $this->color
            ],
        ];


        return $this->sendFMC($data);
    }


    private function sendFMC(Array $data){
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $this->fcm_key,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        return curl_exec($ch);
    }
}

