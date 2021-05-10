<?php

namespace App\Jobs;

ini_set('display_errors', false);
ini_set('display_startup_errors', false);
set_error_handler(null);
set_exception_handler(null);

use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;

use App\Models\RespNegat;
use App\Models\RespPosit;
// use App\Models\Enlaces;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;


class ChequearLinks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $Enlaces = DB::table('enlaces')->pluck('enlaces');
        
        $contar = count($Enlaces);

        logger('inicio desde jobs');

        $respuestaPositiva = [];
        $respuestaNegativa = [];

        for ($i=0; $i < $contar; $i++) {

            // --------------- configuro la variable del url

            $title = $Enlaces[$i];
            // $httcosa = 'http://';$httcosa.
            $url = $title;

            // --------------- inicializo curl pero no lo activo

            $ch = curl_init();
            
            // ----------- seteo la opciones de curl con curl_setopt

            curl_setopt($ch, CURLOPT_URL, $url);        // --------- le paso la url
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_MAXREDIRS, 15);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); // --------- Tiempo de coneccion
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);        // --------- Tiempo de coneccion
            // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_COOKIESESSION, false);
            // curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYSTATUS, false);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-US; rv:1.8.1) Gecko/20061024 BonEcho/2.0");
            /* // ----------- pem
            $public_path = public_path('storage');
            $pem = $public_path.'/cacert.pem';
            // -----agregar pem
            curl_setopt($ch, CURLOPT_CAINFO, $pem); */
            // ------------------ Petición HEAD
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_NOBODY, false);

            //  -------------- Activo Curl
            curl_exec($ch);
            $content = curl_exec($ch);
            
            // $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curl_info = curl_getinfo($ch);
            // $header_size = $curl_info['header_size'];
            // $content_type = $curl_info['content_type'];
            $primary_ip = $curl_info['primary_ip'];
            logger($content);
            logger($curl_info);
            logger($primary_ip);

            if($primary_ip) {
                // ----- success
                array_push($respuestaPositiva, $title);

                $PositivasBd = new RespPosit;
                $PositivasBd->respPosit = $title;
                $PositivasBd->save();

                logger($curl_info);
                
            } else {
                // ---- error: nothing returned
                
                array_push($respuestaNegativa, $title);
                
                $NegativasBd = new RespNegat;
                $NegativasBd->respNegat = $title;
                $NegativasBd->save();

                logger($curl_info);
            }
            
            curl_close($ch);

            

            
            // -------------- comprovacion del error


            // if (!curl_errno($ch)) {
                
            //     array_push($respuestaPositiva, $title);

            //     // $info = curl_getinfo($ch);

            //     // print_r("\nSe recibió respuesta " . $info['http_code'] . ' en ' . $info['total_time'] . " segundos \n");

            // } else {
                
            //     array_push($respuestaNegativa, $title);
                
            //     // print_r("\nError en petición: " . curl_error($ch) . "\n");

            // }


            // --------------- para hacer ping con file_get_contents


            // $opts = array('http' =>
            //                 array(
            //                     'timeout' => 7,
            //                     'error' => false,
            //                     'display_errors' => false,
            //                     'php_network_getaddresses' => false,
            //                     'getaddrinfo' => false,
            //                     'handleError' => false,
            //                 )
            //             );
                                                
            
            // $context  = stream_context_create($opts);
            
            // $content = file_get_contents($url, false, $context);

            // if ($content) {
            //     array_push($respuestaPositiva, $title);

            //     $PositivasBd = new RespPosit;
            //     $PositivasBd->respPosit = $title;
            //     $PositivasBd->save();
                
            // } else {
            //     array_push($respuestaNegativa, $title);
                
            //     $NegativasBd = new RespNegat;
            //     $NegativasBd->respNegat = $title;
            //     $NegativasBd->save();
            // }



            // --------------- para hacer pinh con laravel HTTP
/* 
            $response = Http::withOptions([
                'debug' => false,
                'http_errors' => false,
                'allow_redirects' => true,
                'connect_timeout' => 5,
                'timeout' => 5,
                'verify' => false,
            ])->get($url);
            
            // $response = Http::get($url);
            // $response = Http::post('http://test.com');
            // $response = Http::put('http://test.com');
            // $response = Http::patch('http://test.com');
            // $response = Http::delete('http://test.com');
            // ----- Determine if the status code was >= 200 and < 300...
            $response->successful();
            // ----- Determine if the status code was >= 400...
            $response->failed();
            // ----- Determine if the response has a 400 level status code...
            // $response->clientError();
            // ----- Determine if the response has a 500 level status code...
            // $response->serverError();
            
            if ($response->successful()) {
                array_push($respuestaPositiva, $title);

                $PositivasBd = new RespPosit;
                $PositivasBd->respPosit = $title;
                $PositivasBd->save();
                
            } elseif($response->failed()) {
                array_push($respuestaNegativa, $title);
                
                $NegativasBd = new RespNegat;
                $NegativasBd->respNegat = $title;
                $NegativasBd->save();
            } */

            // ---------finalizo la busqueda

            // ------------ loggeo las respuestas en cantidad
            $Processa = $i+1;
            $contarRP = count($respuestaPositiva);
            $contarRN = count($respuestaNegativa);
            logger('Respuestas Procesadas: '.$Processa);
            logger('Respuestas Positivas Procesadas: '.$contarRP);
            logger('Respuestas Negativas Procesadas: '.$contarRN);
   
        }

        // ------------ loggeo las respuestas

        $rpp = implode(",", $respuestaPositiva);
        logger('Respuestas Positivas: '.$rpp);
        
        $rpn = implode(",", $respuestaNegativa);
        logger('Respuestas Negativas: '.$rpn);

        logger('Se guarda en la base de datos');

        // -------------------------


        logger('finalizo desde jobs');
                
    }

}
