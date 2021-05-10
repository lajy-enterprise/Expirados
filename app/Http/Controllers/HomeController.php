<?php

namespace App\Http\Controllers;

use App\Jobs\ChequearLinks;
use Illuminate\Http\Request;
use Artisan;
use App\Events\chequear;
use Illuminate\Support\Facades\DB;
use App\Models\RespNegat;
use App\Models\RespPosit;
use App\Models\Enlaces;
use App\Models\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function AbrirBuscar()
    {
        
        return view('buscar');
    }


    /**
     * Buscar los enlaces.
     *
     */
    public function BuscarEnlaces(Request $request)
    {
        
        $EnlacesRq = $request->input('Enlace1');
        $rpsc = ["\n", "\r", "\n\r", "\t", ";", "\0", "\x0B", "  ", " ", ",,"];
        $final = str_replace($rpsc, ',', $EnlacesRq);
        $comas = explode(",", $final);
        $contar = count($comas);
            
        if (!$EnlacesRq == NULL) {

            $check = Enlaces::first();
            if(! $check == null){
                $marca=Enlaces::all();;
                foreach($marca as $mar){
                    $mar->delete();
                }
            }

            $checkRP = RespPosit::first();
            if(! $checkRP == null){
                $marcaRP=RespPosit::all();;
                foreach($marcaRP as $marRP){
                    $marRP->delete();
                }
            }
            
            $checkRN = RespNegat::first();
            if(! $checkRN == null){
                $marcaRN=RespNegat::all();;
                foreach($marcaRN as $marRN){
                    $marRN->delete();
                }
            }
            for ($i=0; $i < $contar; $i++) {
                $EnlacesBd = new Enlaces;
                $EnlacesBd->enlaces = $comas[$i];
                $EnlacesBd->save();
            }

        } else {

            return view('buscar')->with('Mensaje', 'No Se Permiten Busquedas Vacias');

        }
        
        logger('desde el controller.!');

        // Artisan::callSilent('queue:work', ['--once']);
        // Artisan::call('queue:work', ['--once']);

        ChequearLinks::dispatch();

        // -----------  redireccionar a procesados

        $RespNegatBd = RespNegat::count();
        $RespPositBd = RespPosit::count();
        $TotalEnlaces = Enlaces::count();

        $totalProc = $RespNegatBd + $RespPositBd;
        $faltan = $TotalEnlaces - $totalProc;

        logger($RespNegatBd);
        logger($RespPositBd);
        logger($totalProc);
        logger($TotalEnlaces);
        
        $PBDCs = RespPosit::all();
        $NBDCs = RespNegat::all();

        logger($PBDCs);
        logger($NBDCs);

        if ($TotalEnlaces == $totalProc) {
            logger('total enlaces si es igual a total procesados desde Buscar enlaces');
            return view('procesados',[
                'PBDCs' => $PBDCs,
                'NBDCs' => $NBDCs,
                ]);
        } else {
            return view('procesados',[
                'Procesando' => 'se han procesado '.$totalProc.' de '.$TotalEnlaces.' enlaces, faltan '.$faltan.' por procesar',
                'PBDCs' => $PBDCs,
                'NBDCs' => $NBDCs,
                ]);
        }
         
    }    

    /**
     * Show the application listo.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function procesados()
    {
        $RespNegatBd = RespNegat::count();
        $RespPositBd = RespPosit::count();
        $TotalEnlaces = Enlaces::count();

        $totalProc = $RespNegatBd + $RespPositBd;
        $faltan = $TotalEnlaces - $totalProc;

        logger($RespNegatBd);
        logger($RespPositBd);
        logger($totalProc);
        logger($TotalEnlaces);

        $PBDCs = RespPosit::all();
        $NBDCs = RespNegat::all();

        // $PBDCs = DB::table('resp_Posits')->pluck('respPosit');
        
        // $NBDCs = DB::table('resp_Negats')->pluck('respNegat');
        
        logger($PBDCs);
        logger($NBDCs);

        if ($TotalEnlaces == $totalProc) {
            logger('total enlaces si es igual a total procesados desde procesados');
            return view('procesados', [
                'PBDCs' => $PBDCs,
                'NBDCs' => $NBDCs,
                ]);
                
                
        } else {
            logger('total enlaces no es igual a total procesados desde procesados');
            return view('procesados',[
                'Procesando' => 'se han procesado '.$totalProc.' de '.$TotalEnlaces.' enlaces, faltan '.$faltan.' por procesar',
                'PBDCs' => $PBDCs,
                'NBDCs' => $NBDCs,
                ]);
        }
        
    }
}
