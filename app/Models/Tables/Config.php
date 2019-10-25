<?php
namespace App\Models\Tables;

use Illuminate\Support\Facades\DB;

use App\Models\AllModel;

use App\Models\Tables\ConfigValor;

class Config extends AllModel
{
    public $timestamps = false;

    protected $fillable = [
        'id','nome','nome_interno','descricao','multiplo','ativo'
    ];

    public function valores(){ return $this->hasMany(ConfigValor::class); }

    public static function criar($config, $valores){
        DB::beginTransaction();

        $Config = self::create($config);

        array_walk(
            $valores,
            function(&$item, $key, $Config){
                $item = ['config_id'=>$Config->id, 'valor'=>$item];
            },
            $Config
        );

        $ConfigValor = $Config->valores()->createMany($valores);

        DB::commit();

        return $Config;
    }

    public static function atualizar($config, $valores){
        DB::beginTransaction();

        $result = self::find($config['id'])->fill($config)->update();
        $Config = self::find($config['id']);

        self::apagarValores($Config);

        $ConfigValor = self::gravarValores($Config, $valores);

        DB::commit();

        return $Config;
    }

    private static function apagarValores(Config $Config){
        $valores_ids = array_map(function($valor){ return $valor->id; }, $Config->valores->all());
        $valores_delete = ConfigValor::destroy($valores_ids);
        return $valores_delete;
    }

    private static function gravarValores(Config $Config, array $valores){
        array_walk(
            $valores,
            function(&$item, $key, $Config){
                $item = ['config_id'=>$Config->id, 'valor'=>$item];
            },
            $Config
        );

        return $Config->valores()->createMany($valores);
    }

}
