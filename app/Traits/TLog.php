<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Tables\Log as TableLog;

trait TLog {

    /**
    * ======== Tipos de log e suas utilizacoes ===========

    * emergency, // EXCLUSIVO para atuacoes do laravel, onde o sistema não conseguiu tratar
    * error, // EXCLUSIVO para atuacoes do laravel, para erros em geral como exceções não tratadas
    *
    * alert, //para erros em geral que possível realizar algum tratamento
    * info, //informacoes de uso em geral do sistema (menor nivel de registro geral do sistema)
    *
    * debug, // EXCLUSIVO para uso do programador

    *critical, warning, notice //não usados por enquanto
    */

    public static function alertLog(string $mensagem, array $infoextra=[], $gravar_bd=true)
    {
        $stack = ['todos','alert'];
        Log::stack($stack)->alert($mensagem, $infoextra);
        if($gravar_bd){
            self::logBD($mensagem, $infoextra,'ALERT');
        }
    }

    public static function infoLog(string $mensagem, array $infoextra=[], $gravar_bd=false)
    {
        $stack = ['todos','info'];
        Log::stack($stack)->info($mensagem, $infoextra);
        if($gravar_bd){
            self::logBD($mensagem, $infoextra,'INFO');
        }
    }

    public static function debugLog(string $mensagem, array $infoextra=[], $gravar_bd=false)
    {
        $stack = ['todos','debug'];
        Log::stack($stack)->debug($mensagem, $infoextra);
        if($gravar_bd){
            self::logBD($mensagem, $infoextra,'DEBUG');
        }
    }

    public static function logBD(string $mensagem, array $infoextra=[], $nivel='INFO'){
        $dados = [
            'user_id'=>Auth::user()->id ?? null,
            'datahora'=>(new \Datetime())->format('Y-m-d H:i:s'),
            'nivel'=>$nivel,
            'mensagem'=>$mensagem,
            'extra'=>implode(' || ', $infoextra),
        ];
        TableLog::create($dados);
    }

}
