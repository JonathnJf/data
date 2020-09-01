<?php 
  require 'coordenadas.php'; 
  require 'banco.php'; 
  
  $banco = new Banco("localhost","data","root","");
  $coordenadas = new Coordenadas();

      if (isset($_POST['cep_origem']) && !empty($_POST['cep_origem'])){
          $cep_origem = $_POST['cep_origem']; 
         
     
         $origemRetorno = json_decode($coordenadas->retornaCoodernadas($cep_origem));
         
         $latOrigem = $origemRetorno[0];
         $lonOrigem = $origemRetorno[1]; 
         
        echo "CEP de Origem: ".$cep_origem."</br> 
        Latitude: ".$latOrigem."</br> 
        Longitude: ".$lonOrigem ."</br></br></br>"; 
        
        
      }else{ 
        
        echo "CEP DE ORIGEM NAO PREENCHIDO </br>";

      } 
    
       

    if (isset($_POST['cep_destino']) && !empty($_POST['cep_destino'])){
         $cep_destino = $_POST['cep_destino']; 
        
        sleep(10);   
        $destinoRetorno = json_decode($coordenadas->retornaCoodernadas($cep_destino));
        $latDestino = $destinoRetorno[0]; 
        $lonDestino = $destinoRetorno[1];  

        echo "CEP de Destino: ".$cep_destino."</br> 
        Latitude: ".$latDestino."</br> 
        Longitude: ".$lonDestino ."</br></br></br>"; 
        
        
    }else{ 
      
       echo "CEP DE DESTINO NAO PREENCHIDO </br>";

    } 

    if (!empty($latOrigem) && !empty($lonOrigem) && !empty($latDestino) && !empty($lonDestino)){ 

      $distancia= $coordenadas->retornaDistancia($latOrigem,$lonOrigem,$latDestino,$lonDestino,"K");

      echo "Distancia entre os CEPS em KM: ".$distancia;

 
      $banco->insert("t_distanciamento", array("cep_origem" => $cep_origem, 
                                               "cep_destino" => $cep_destino, 
                                               "distancia_calculada" =>$distancia, 
                                               "dt_cadastro" =>date("Y/m/d H:i:s"),
                                               "dt_alteracao" =>date("Y/m/d H:i:s")
        ));
 
    
   }
    
    

  
?>