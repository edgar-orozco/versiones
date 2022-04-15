<?php

namespace EdgarOrozco\Versiones;

class Transformer
{
    public function transformaArregloLogs($log, $max, $url){

        $lineas = [];

        foreach ($log as $idx => $linea) {
            if(trim($linea) == '') continue;

            if(preg_match('/^commit (.+)$/', $linea)){
                $lineas[] = $this->transCommit($linea);
                continue;
            }

            if(preg_match('/^Author:(.+)$/', $linea)){
                $lineas[] = $this->transAuthor($linea);
                continue;
            }

            if(preg_match('/^Date:(.+)$/', $linea)){
                $lineas[] = $this->transDate($linea);
                continue;
            }

            $lineas[] = $this->transComment($linea, $url);

            if($idx > $max){
                break;
            }
        }

        return $lineas;
    }

    public function transCommit($commit){
        return "<div class=\"commit\">".$commit."</div>";
    }
    public function transAuthor($author){
        return "<div class=\"author\">".$author."</div>";
    }
    public function transDate($date){
        return "<div class=\"date\">".$date."</div>";
    }
    public function transComment($comment, $url){
        $comment = preg_replace('/\(#(\d+)\)/', "<a href=\"${url}$1\" target='_blank'>(#$1)</a>", $comment);
        return "<div class=\"comment\">".$comment."</div>";
    }
}
