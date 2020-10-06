<?php
namespace frontend\modules\sta\components;
use common\helpers\h;
use common\models\base\modelBase;
use common\helpers\timeHelper;
class Indicadores {
    
private static function queryCitasCount(){
  return h::obQuery()->select('count(*)')
 ->from(['a'=>'{{%sta_citas}}']) ;
}
private static function queryCitasCountByFacu(){
  return h::obQuery()->select(['count(codfac) as ncitas','codfac'])
 ->from(['a'=>'{{%sta_citas}}']) ;
}


public static function nCitasTotales(){
   return self::queryCitasCount()->
   where(['activo'=>'1'])->scalar();
}

public static function nAsistencias(){
     $horas=h::gsetting('sta', 'nhorasreprogramacion');
     $carbonAtras= modelBase::CarbonNow()->subHours($horas);  
 
  return self::queryCitasCount()->
 where([
     'activo'=>'1',
     'asistio'=>'1',
     
     ] )->
     andWhere([
         '<',
         'fechaprog',$carbonAtras->format(timeHelper::formatMysqlDateTime())
      ])->scalar();
}

public function asistenciaGlobal(){
    $totales=self::nCitasTotales();
    if($totales>0)
    return self::nAsistencias()/$totales;
    return 0;
}

public static function citasFacultades(){
  // echo self::queryCitasCountByFacu()->groupBy('codfac')->createCommand()->getRawSql();die();
   $filas= self::queryCitasCountByFacu()->groupBy('codfac')->all();
   return array_combine(
          array_column($filas,'codfac'),
          array_column($filas,'ncitas')
          );
}
public static function asistenciasFacultades(){
  $horas=h::gsetting('sta', 'nhorasreprogramacion');
     $carbonAtras= modelBase::CarbonNow()->subHours($horas);
  $filas= self::queryCitasCountByFacu()->
 where([
     'activo'=>'1',
     'asistio'=>'1',
     
     ] )->
     andWhere([
         '<',
         'fechaprog',$carbonAtras->format(timeHelper::formatMysqlDateTime())
      ])->groupBy('codfac')->all();
  return array_combine(
          array_column($filas,'codfac'),
          array_column($filas,'ncitas')
          );
}

public static function IAsistenciasPorFacultad(){
    $asistencias=self::asistenciasFacultades();
    $citas=self::citasFacultades();
    $facultadesTotales=\frontend\modules\sta\models\Facultades::find()->select(['codfac'])->column();
   
    $faltanFacultadesCitas=array_diff($facultadesTotales,array_keys($citas));
    foreach($faltanFacultadesCitas as $codfacultad){
        $citas[$codfacultad]=0;
    }
    
    
    $faltanFacultadesAsistencias=array_diff(array_keys($citas),array_keys($asistencias));
    foreach($faltanFacultadesAsistencias as $codfacultad){
        $asistencias[$codfacultad]=0;
    }
    
    $indicador=[];
    foreach($citas as $codfac=>$numerocitas){
        $indicador[$codfac]['ncitas']=$numerocitas;
        $indicador[$codfac]['nasistencias']=$asistencias[$codfac]+0;
         $indicador[$codfac]['pasistencias']=(($numerocitas+0)>0)?round($asistencias[$codfac]*100/($numerocitas+0),1):0;
    }
  return $indicador;  
}




    
}

?>

