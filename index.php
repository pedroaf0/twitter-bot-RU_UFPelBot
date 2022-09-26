<?php

require_once './env.php';





           

           $curl = curl_init();

           $curl = curl_init();

           curl_setopt_array($curl, array(
             CURLOPT_URL => "https://cobalto.ufpel.edu.br/dashboard/cardapios/cardapio/listaCardapios?null&cmbRestaurante=6&_search=false&nd=1664135529458&rows=-1&page=1&sidx=refeicao+asc%2C+id&sord=asc",
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => "",
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 30,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => "GET"
           ));
           
           $response = curl_exec($curl);
           $err = curl_error($curl);
           
           curl_close($curl);
           
           if ($err) {
             echo "cURL Error #:" . $err;
           } else {
             echo $response;
           }


           $date=date_create();
           echo date_format($date,"d/m");
           $tmessage = "Almoço ".date_format($date,"d/m")."\n\n";

           for ($x = 0; $x <= count(json_decode($response)->rows); $x++) {
            if (json_decode($response)->rows[$x]->refeicao == "ALMOÇO") {
              $tmessage .= json_decode($response)->rows[$x]->nome."\n";
            }
          }

          echo $tmessage;
          use DG\Twitter\Twitter;

          require_once './src/twitter.class.php';

          // ENTER HERE YOUR CREDENTIALS (see readme.txt)
          $twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

          try {
            $tweet = $twitter->send($tmessage); // you can add $imagePath or array of image paths as second argument

          } catch (DG\Twitter\TwitterException $e) {
            echo 'Error: ' . $e->getMessage();
          }

?>