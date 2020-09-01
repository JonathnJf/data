<?php

class Coordenadas { 

    public function retornaCoodernadas($cep) { 
      
      $url = 'https://www.cepaberto.com/api/v3/cep?cep='.$cep;
      $token = "37d6aedd7153e7d0f22145b777c798c0";
      $curl = curl_init();

          curl_setopt_array($curl, array(
               CURLOPT_URL => $url,
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_SSL_VERIFYPEER => false, 
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 0,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "GET",
               CURLOPT_HTTPHEADER => array('Authorization: Token token="' . $token . '"'),
          ));                
               $response = curl_exec($curl);
               curl_close($curl);
               if($response == '{}'){ 
                
                $falha = "CEP nao encontrado";    
                return $falha;
                                 
              }else{ 
                $json = json_decode($response);
                $coordenadas = array($json->latitude, $json->longitude);  
                $coordenadas = json_encode($coordenadas); 
                 return $coordenadas; 
             }
          
  }

    public function retornaDistancia($lat1, $lon1, $lat2, $lon2, $unit) { 
  
          $radius = 6378.137; 
          $dlon = $lon1 - $lon2; 
          $distancia = acos( sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($dlon))) * $radius; 

          if ($unit == "K") {
              return ($distancia); 
          } else if ($unit == "M") {
              return ($distancia * 0.621371192);
          } else if ($unit == "N") {
              return ($distancia * 0.539956803);
          } else {
              return 0;
          }

    }



}
   
?>

