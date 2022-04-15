<?php

namespace EdgarOrozco\Versiones\Controllers;

use EdgarOrozco\Versiones\Facades\Versiones;
use EdgarOrozco\Versiones\Transformer;

use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;


class VersionesController extends Controller
{
    protected $trans;

    /**
     * VersionesController constructor.
     * @param Transformer $transformer
     */
    public function __construct(Transformer $transformer){
        $this->trans = $transformer;
    }

    /**
     * Muestra los datos de hash de commit, fecha, tag, etc. que conforman una versión.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function getVersion(Request $request){

        switch ($request->get('cmd')){
            case 'status':
                return Versiones::status();
                break;
            case 'ramas':
                return $this->getRamasRemotas();
                break;
            default:
                return $this->version();
                break;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getActualizaciones(Request $request){
        list($rama_actual, $hash, $fecha) = Versiones::version();
        $log = \Session::get('log', []);
        return view('EdgarOrozco::versiones.actualizaciones', compact('rama_actual', 'hash', 'fecha', 'log'));
    }

    /**
     * Muestra la versión y el commit log de la versión
     * @return \Illuminate\Http\JsonResponse
     */
    public function version(){
        list($rama, $hash, $fecha) = Versiones::version();
        return response()->json(['hash' => $hash, 'fecha' => $fecha, 'rama' => $rama, 'errors'=>$this->errors]);
    }

    /**
     * @return mixed
     */
    public function status()
    {
        return Versiones::status();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRamasRemotas()
    {
        list($rama_actual, $hash, $fecha) = Versiones::version();
        $ramas = Versiones::getRamasRemotas();
        $log = $this->trans->transformaArregloLogs(Versiones::logPorRama($rama_actual), 200, Versiones::repo());
        return view('EdgarOrozco::versiones.versiones', compact('ramas', 'rama_actual', 'hash', 'fecha', 'log'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function cambiarRama(Request $request){
        $rama = $request->get('rama');
        list($rama_actual, $hash, $fecha) = Versiones::version();
        Versiones::cambiarRama($rama);
        return back()->withSuccess('Se ha cambiado de la rama: "'.$rama_actual .'" a la rama: "'.$rama.'"');
    }

    /**
     * Ejecuta el git pull
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pull(Request $request) {
        $log = Versiones::pull();
        return back()->with(['log'=>$log]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fetch(Request $request) {
        $log = Versiones::fetch();
        return back()->with(['log'=>$log]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function migrate(Request $request) {
        $log = Versiones::migrate();
        return back()->with(['log'=>$log]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function composerInstall(Request $request) {
        try {
            $log = Versiones::composerInstall();
        } catch (\Exception $e) {
            $log = Versiones::salidaLineas($e->getMessage());
        }
        return back()->with(['log'=>$log]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getStatus(Request $request) {
        $log = Versiones::salidaLineas(Versiones::status());
        return back()->with(['log'=>$log]);
    }

}
