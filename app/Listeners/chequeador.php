<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\RespNegat;
use App\Models\RespPosit;
// use App\Models\Enlaces;
use Illuminate\Support\Facades\DB;

class chequeador
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        logger('desde el listener.!');
        error_reporting(E_ALL ^ E_NOTICE);
        ini_set('display_errors', false);
        ini_set('display_startup_errors', false);

        $Enlaces = DB::table('Enlaces')->pluck('Enlaces');
        
        $contar = count($Enlaces);

        logger('inicio desde jobs');

        $EnlacesCap = [];

        $respuestaPositiva = [];
        $respuestaNegativa = [];

        for ($i=0; $i < $contar; $i++) {

            $title = $Enlaces[$i];

            $httcosa = 'https://';
            
            $url = $httcosa.$title;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 15);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_COOKIESESSION, false);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYSTATUS, false);

            // Petición HEAD
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_NOBODY, false);

            $content = curl_exec($ch);

            while (curl_getinfo($ch)['http_code'] >= 300
            and curl_getinfo($ch)['http_code'] < 400) {
            // new URL to be redirected
            curl_setopt($ch, CURLOPT_URL, curl_getinfo($ch)
            ['redirect_url']);
            curl_exec($ch);
            }
            if (curl_getinfo($ch)['http_code'] >= 200
            and curl_getinfo($ch)['http_code'] < 300) {
            // echo 'OK'.PHP_EOL;
            array_push($respuestaPositiva, $title);
            } else {
            // echo 'KO'.PHP_EOL;
            array_push($respuestaNegativa, $title);
            }
            curl_close($ch);

            $Processa = $i+1;
            $contarRP = count($respuestaPositiva);
            $contarRN = count($respuestaNegativa);
            logger('Respuestas Procesadas: '.$Processa);
            logger('Respuestas Positivas Procesadas: '.$contarRP);
            logger('Respuestas Negativas Procesadas: '.$contarRN);


            // if (!curl_errno($ch)) {
                
            //     array_push($respuestaPositiva, $title);

            //     // $info = curl_getinfo($ch);

            //     // print_r("\nSe recibió respuesta " . $info['http_code'] . ' en ' . $info['total_time'] . " segundos \n");

            // } else {
                
            //     array_push($respuestaNegativa, $title);
                
            //     // print_r("\nError en petición: " . curl_error($ch) . "\n");

            // }

            // $opts = array('http' =>
            //                 array(
            //                     'timeout' => 25,
            //                     'error' => false,
            //                     'display_errors', false,
            //                 )
            //             );
                                                
            
            // $context  = stream_context_create($opts);
            
            // $content = file_get_contents($url, false, $context);

            // if ($content) {
            //     array_push($respuestaPositiva, $title);
                
            // } else {
            //     array_push($respuestaNegativa, $title);
                
            // }

            // array_push($EnlacesCap, $title);
            
        }

        $rpp = implode(",", $respuestaPositiva);
        
        logger('Respuestas Positivas: '.$rpp);

        $rpn = implode(",", $respuestaNegativa);
        
        logger('Respuestas Negativas: '.$rpn);

        // $rp = implode(",", $EnlacesCap);
        
        // logger('Enlaces Capturados: '.$rp);
 
        logger('finalizo desde listener');
        
        // return view('procesados');
    }
}
