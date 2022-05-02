<?php

namespace EdgarOrozco\versiones;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class versiones
{
    /**
     * Ejecuta el comando
     * @param $cmd
     * @return string
     */
    public function ejecuta($cmd)
    {
        $process = new Process($cmd);
        $process->setWorkingDirectory(base_path());
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        return trim($process->getOutput());
    }

    /**
     * Devuelve datos de identificación de hash y rama
     * @return array
     */
    public function version(){
        $rama = $this->ejecuta('git rev-parse --abbrev-ref HEAD');
        $hash = $this->ejecuta('git log --pretty="%h" -n1 HEAD');
        $fecha= $this->ejecuta('git log -n1 --pretty=%ci HEAD');
        return [$rama, $hash, $fecha];
    }

    /**
     * Devuelve listado de ramas
     * @return array
     */
    public function getRamasRemotas(){
        $sramas = $this->ejecuta('git branch -r');
        $ramas = explode("\n", $sramas);

        $filtradas = [];
        foreach($ramas as $idx => $r) {
            //if(strpos($r, $rama_actual) !== false) continue;
            list($origin,$local) = explode("/", $r);
            $r = str_replace('*','',$r);
            $filtradas[] = trim($r);
        }

        $ramas = $filtradas;
        return $ramas;
    }

    /**
     * Aplica cambio de rama
     * @param $rama
     */
    public function cambiarRama($rama){

        list($remote, $local) = explode("/", $rama);

        $chorem = $this->ejecuta('git stash; git checkout '.$rama.'; git stash pop');

        $choloc = $this->ejecuta('git stash; git checkout '.$local.'; git stash pop');

        return;
    }

    /**
     * Devuelve la salida de consulta de cambios contenidos en una rama
     * @param $rama
     * @return array
     */
    public function logPorRama($rama) {
        return $this->salidaLineas($this->ejecuta('git log '.$rama));
    }
    public function status(){
        return $this->ejecuta('git status');
    }
    public function pull(){
        return $this->salidaLineas($this->ejecuta('git pull'));
    }
    public function fetch(){
        return $this->salidaLineas($this->ejecuta('git fetch'));
    }
    public function migrate(){
        return $this->salidaLineas($this->ejecuta('php artisan migrate'));
    }
    public function composerInstall(){
        return $this->salidaLineas($this->ejecuta('composer install'));
    }

    public function salidaLineas($log){
        $lineas = [];
        foreach(explode("\n", $log) as $linea){
            $lineas[] = $linea;
        }
        return $lineas;
    }
}
