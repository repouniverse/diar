<?php

namespace frontend\modules\sta\models;
use common\models\masters\Trabajadores;
use frontend\modules\import\models\ImportCargamasiva;
use frontend\modules\sta\models\Talleres;
use frontend\modules\sta\models\Talleresdet;
use common\helpers\h;
use yii\validators\EmailValidator;
use frontend\modules\import\components\CSVReader as MyCSVReader;
use Yii;
use common\traits\timeTrait;
use common\behaviors\FileBehavior;
/**
 * This is the model class for table "{{%sta_eventos}}".
 *
 * @property int $id
 * @property int $talleres_id
 * @property string $descripcion
 * @property string $numero
 * @property string $fechaprog
 * @property string $tipo
 * @property string $codtra
 *
 * @property Trabajadores $codtra0
 * @property StaTalleres $talleres
 */
class StaEventos extends \common\models\base\modelBase
{
   use timeTrait;
    public $prefijo='97';
    private $_codes=[];
    public $dateorTimeFields=['fechaprog'=>self::_FDATETIME];
    private $_csv=null;
    
     
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_eventos}}';
    }
public function behaviors()
         {
                return [
		'fileBehavior' => [
			'class' => FileBehavior::className()
		],
		/*'fileBehavior' => [
			'class' => '\frontend\modules\attachments\behaviors\FileBehaviorAdvanced' 
                               ],*/
                    'auditoriaBehavior' => [
			'class' => '\common\behaviors\AuditBehavior' ,
                               ],
		
                    ];
        }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['talleres_id', 'descripcion', 'fechaprog', 'tipo', 'codtra','semana'], 'required'],
            [['talleres_id','semana'], 'integer'],
            [['descripcion'], 'string', 'max' => 40],
            [['codfac','semana','detalle'], 'safe'],
            
             [['fechaprog'], 'validateFecha'],
            [['fechaprog'], 'string', 'max' => 19],
            [['tipo'], 'integer'],
            [['codtra'], 'string', 'max' => 6],
            [['codtra'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajadores::className(), 'targetAttribute' => ['codtra' => 'codigotra']],
            [['talleres_id'], 'exist', 'skipOnError' => true, 'targetClass' =>Talleres::className(), 'targetAttribute' => ['talleres_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'talleres_id' => Yii::t('sta.labels', 'Talleres ID'),
            'descripcion' => Yii::t('sta.labels', 'Descripcion'),
            'numero' => Yii::t('sta.labels', 'Numero'),
            'fechaprog' => Yii::t('sta.labels', 'Fechaprog'),
            'tipo' => Yii::t('sta.labels', 'Tipo'),
            'codtra' => Yii::t('sta.labels', 'Codtra'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajador()
    {
        return $this->hasOne(Trabajadores::className(), ['codigotra' => 'codtra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTalleres()
    {
        return $this->hasOne(Talleres::className(), ['id' => 'talleres_id']);
    }
    
     public function getDetalles()
    {
        return $this->hasMany(StaEventosdet::className(), ['eventos_id'=>'id']);
        //return $this->hasMany(Examenes::className(), ['citas_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return StaEventosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaEventosQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
        if($insert){
            $this->numero=$this->correlativo('numero');
        }
        return parent::beforeSave($insert);
    }
    
    public function afterSave($insert, $changedAttributes) {
        if($insert){           
         // $this->addAlumnos();  
        }
       return parent::afterSave($insert, $changedAttributes);
    }
    
    
    private function freshCodes(){
        //Obteniendo los codigos totales del rporgegna
      $codes=$this->talleres->codeStudents();
     $codesEventos= StaEventosdet::find()->select(['codalu'])->
              andWhere(['talleres_id'=>$this->talleres_id/*,'asistio'=>'0'*/])->column();
    $cantidad= h::gsetting('sta','NumeroAlumnosPorGrupo');
    $codesListos=array_diff($codes,$codesEventos);
    RETURN array_slice($codesListos,0,$cantidad);
    }
    
    
    
    public function addAlumnos(){
       // $contador=0;
        $info=[];
        foreach ($this->freshCodes() as $key=>$code){
          $info[]=$this->creaDetalle($code);  
          //$contador++;
        }
       return $info;
    }
    pUBLIC function creaDetalle($code){
        /*
         * Debemos asegurarnos que este alumno no 
         * este registrado en otros eventos de la misma 
         * "semana" al decir semana no quiere decir semana cronologica,
         * quiere decir numero de semana referencial para agrupar 
         * todos los eventos en un mismo grupo 
         */
        $errores=[];
        if(!$this->codeInPrograma($code)){
            return ['error'=>yii::t('sta.labels','El alumno "{codigo}" no está dentro del programa',['codigo'=>$code])];
        }
                
        if(!$this->codeIsFree($code)){
           return ['error'=>yii::t('sta.labels','El alumno "{codigo}" ya está dentro de otro evento',['codigo'=>$code])];
        
        }
        
        
        //var_dump($this->id);die();
       $tallerdet= Talleresdet::find()->andWhere([ 
           'codalu'=>$code,
           'talleres_id'=>$this->talleres_id,
       ])->One(); 
       $alumno=$tallerdet->alumno;
       $nombres=substr($alumno->fullName(),0,60);
       $attributes=[
           'eventos_id'=>$this->id,
           'talleresdet_id'=>$tallerdet->id,
           'talleres_id'=>$tallerdet->talleres_id,
           'codalu'=>$code,
           'nombres'=>$nombres,
            'celulares'=>$alumno->celulares,
           'asistio'=>'0',
           'libre'=>'0',
           'detalle'=>'Convocatoria masiva',
            'codfac'=>$tallerdet->codfac,
           'correo'=>$alumno->correo,
       ];
       unset($alumno);unset($tallerdet);
       $verifyAttributes=[
           'eventos_id'=>$this->id,
           'codalu'=>$code,
       ];
    if(StaEventosdet::firstOrCreateStatic($attributes, null, $verifyAttributes)){
        return ['success'=>yii::t('sta.labels','El alumno "{codigo}" Se agregó al evento',['codigo'=>$code])];
    }else{
        return ['error '=>yii::t('sta.labels','El alumno "{codigo}" Se agregó al evento',['codigo'=>$code])];
    }
       
       
    }
    
   public function correos(){
      $correos= $this->getDetalles()->select(['correo'])->andWhere(['not',['correo'=>null]])->column();
      $correosValidos=[];
      $validador=New EmailValidator();
      foreach($correos as $key=>$correo){
          if($validador->validate($correo))
          $correosValidos[]=$correo;
      }
      
      return $correosValidos;
   } 
   
   public function notificaCitas(){
       //var_dump($this->correos());die();
       $mailer = new \common\components\Mailer();
        $message =new  \yii\swiftmailer\Message();
            $message->setSubject('Tienes una cita programada')
            ->setFrom([\common\helpers\h::gsetting('mail', 'userservermail')=>'Oficina Tutoría Psicológica UNI'])
            ->setTo($this->correos())
           /*
            * Borrar esta linea si hay algun error
            */
             ->setReplyTo($this->talleres->listMailsFromTutores())      
            /*
             * Din de la iena a borar
             */
            ->SetHtmlBody("Buenas Tardes  <br>"
                    . "La presente es para notificarle que tiene "
                    . "una cita  programada. <br> para el día ".$this->fechaprog."<br>"
                    . "acércate a la oficina de tutoría de tu facultad, ¡ Te esperamos ...!");
           
    try {
        
           $result = $mailer->send($message);
           $mensajes['success']='Se envió el correo, invitando a la convocatoria ';
    } catch (\Swift_TransportException $Ste) {      
         $mensajes['error']=$Ste->getMessage();
    }
    return $mensajes;
    }

   
public function validateFecha($attribute, $params)
    {
      /* if($this->isHolyDay($this->toCarbon('fechaprog'))){
        $this->addError('fechaprog',yii::t('sta.errors','La fecha se encuentra en un día no laborable'));
          }*/
       if(!$this->isNewRecord){
          if($this->hasChanged('fechaprog')){
            //no puede cambiar fecha si ya tiene  detalles con aistencia
           /* if($this->isDateConfirmed()){
                //return ['error'=>yii::t('sta.errors','Ya no puede agregar grupos de alumnos, sólo puede hacerlo con  {horas} horas de anticipación',['horas'=>h::gsetting('sta','nhorasantesevento')])]; 
      
               $this->addError('fechaprog',yii::t('sta.errors','No puede modificar la fecha, sólo puede hacerlo con  {horas} horas de anticipación',['horas'=>h::gsetting('sta','nhorasantesevento')]));
              
            }*/
            if($this->hasAsistencias()){
              $this->addError('fechaprog',yii::t('sta.errors','No puede modificar la fecha, ya hay asistentes'));
             
            } 
              
       
                        }  
          } 
      if($this->isNewRecord)    
       if($this->toCarbon('fechaprog')->lessThan(self::CarbonNow())) {
           $this->addError('fechaprog',yii::t('sta.errors','La fecha se encuentra en el pasado '));
                  } 
    }    
  
    
public function hasAsistencias(){
   return $this->getDetalles()->andWhere(['asistio'=>'1'])->exists();
    
}    

/*
 * Retorna codigos de alumnos que no aistieron en citas aneriores
 * Pero estos codigos solo de eventos anteriores a este evento
 * que no han sido marcados como asistencia
 */
private function freshCodeRezagados(){
   $eventosId=StaEventos::find()->select(['id'])->where([
        'talleres_id'=>$this->talleres_id/*,'asistio'=>'0'*/,
       '<','fechaprog',$this->swichtDate('fechaprog',false)
       ])->column();
  $codesRezagados= StaEventosdet::find()->select(['codalu'])->
              andWhere([
                  'talleres_id'=>$this->talleres_id/*,'asistio'=>'0'*/,
                  'asistio'=>'0',
                  'eventos_id'=>$eventosId,
                  ]                    
                      )->column();
 $codesInThis=$this->codesInThis();
 return array_diff($codesRezagados,$codesInThis);
}

public function codesInThis(){
    return $this->getDetalles()->select(['codalu'])->column();
}

/*
 * Retorna inserta los alumnos que no asisitieron en citas anteriores
 */
public function addAlumnosRezagados(){
       $info=[];
        foreach ($this->freshCodeRezagados() as $key=>$code){
          $info[]=$this->creaDetalle($code);  
        }
       return $info;
    }
   /*
    * Determina sie le vento ya esta cofirmado  y ya no puede mover fechas
    * ni agregar alum,nos en masa
    * se califica automaticamente 24 horas antes de la fecha progarmada 
    * configruacion en settings
    */     
   public function isDateConfirmed(){
       return self::CarbonNow()->greaterThan( $this->toCarbon('fechaprog')->subHours(h::gsetting('sta','nhorasantesevento')));
   } 
   
   /*
    * califica cuando llega la fecha del evento en adelante
    * 
    * se califica autoamticmente con una hora de anticipacion y pude hacer lo hasta 24 horas despues
    */
   public function isDateToWork(){
    // return true;
     return  (self::CarbonNow()->greaterThan( $this->toCarbon('fechaprog')->subHours(1)) && 
             self::CarbonNow()->lessThan($this->toCarbon('fechaprog')->addHours(24)));
   }
   
   
   public function closeEvento(){
       $detalles=$this->getDetalles()->andWhere(['asistio'=>'0'])->all();
       foreach($detalles as $detalle){
        
         yii::error('recorriendo el for',__FUNCTION__);
          $cita=$detalle->createCita($this->codtra,$this->fechaprog,$this->tipo,false); 
         if(!is_null($cita)){
              yii::error('Cita creada',__FUNCTION__);
            $numeroCita=$cita->numero;
            $detalle-> updateNumeroCita($numeroCita); 
             $detalle-> updateLibre($numeroCita); 
           // $detalle->numerocita=$cita->numero;
           //$detalle->updateAsistencia();
         }else{
            yii::error('NO se ha creado, mire lose rrores arriba',__FUNCTION__); 
         }
        
       }
   }
  
     public function getCsv(){
     //var_dump($this->firstLineTobegin());die();
        //yii::error('primera linea para importar:  '.$this->firstLineTobegin(),__METHOD__);
      $path=$this->pathFileCsv();
      //var_dump($path);die();
         if(is_null($this->_csv) && !is_null($path)){
        // var_dump($this->pathFileCsv());die();
          $this->_csv= New MyCSVReader( [
                 'filename' => $path,
              'startFromLine' =>1,//$this->firstLineTobegin(),
                 'fgetcsvOptions' => [ 
                                     'delimiter' => h::gsetting('import', 'delimiterCsv'),
                                       ] 
                                ]);
          return $this->_csv;
      }else{
       return $this->_csv;   
      }
    } 
    public function pathFileCsv(){
    $registros=$this->getFilesByExtension(ImportCargamasiva::EXTENSION_CSV);
    if(count($registros)>0){
        return $registros[0]->getPath();
    }else{
        return null;
        //$this->addError('numero',yii::t('import.errors','No hay ningún archivo adjunto para efectuar la importación'));
    } 
       
   }
   
   /*
     * Obtiene el array de datos a cargar, lee 
     * el archivo csv de disco 
     * USa la libreria MyCSVrEADER , que no es nada del otro mundo
     * solo para ahora trabajo de leer un formato csv 
     */
    public function dataToImport(){
      //yii::error('comenzando a leer el csv',__METHOD__);
      if($this->hasFileCsv()){
         $datos= $this->csv->readFile();  
      }else{
        $datos=[];   
      }
     
     
      //$this->total_linea=count($datos);
      return $datos;
  }  
  
   public function hasFileCsv(){
    $registros=$this->getFilesByExtension(ImportCargamasiva::EXTENSION_CSV);
      $tiene= (count($registros)>0)?true:false; 
       if(!$tiene){
           $this->addError('numero',yii::t('import.errors','Este registro no tiene adjuntado ningun archivo '.ImportCargamasiva::EXTENSION_CSV));
           return false;   
       }
       return true;
   }  
   
  public function addCodesFromCsv(){
      $info=[];
     foreach($this->dataToImport() as $filaDato){
          $code=$filaDato[0];
          $info[]=$this->creaDetalle($code);
      }
      return $info;
  }
  
 public function codes(){
     if(count($this->_codes)==0){
         return $this->talleres->codeStudents();
     }else{
         return $this->_codes;
     }
 } 
  
 public function codeInPrograma($code){    
   return  in_array($code,$this->codes());
 } 
 
public function codeIsFree($code){
    $idsEventos=self::find()->select(['id'])->
    andWhere(['semana'=>$this->semana])->column();
    $convocado= StaEventosdet::find()->select(['id'])->andWhere([
         'eventos_id'=>$idsEventos,
         'codalu'=>$code,
        // 'asistio'=>'1'
     ])->exists();
    
    $asistio=StaEventosdet::find()->select(['id'])->andWhere([
         'eventos_id'=>$idsEventos,
         'codalu'=>$code,
         'asistio'=>'1'
     ])->exists();
    
    $esclavizado=StaEventosdet::find()->select(['id'])->andWhere([
         'eventos_id'=>$idsEventos,
         'codalu'=>$code,
         'libre'=>'0'
     ])->exists();
    
    
    
    
    
    if(!$convocado){
        return true;
    }else{
        if($asistio){
            return false;
        }else{
           if($esclavizado){
               return false;
           }else{
               return true;
           }
        }
    }
   
 }
 
 /*El evento esta cerrado siempre y cuando porlo 
  * menos haya un registro detalle con el flag libre 
  * esto quiere decir qeu ya se proceso masivamente
  */
 public function isClosed(){
     $existe=$this->getDetalles()->select(['id'])->andWhere(['libre'=>'1'])->exists();
     $cienporcien=($this->nAsistencias()==$this->getDetalles()->count());
    // $queryDetalles=$this->getDetalles();
     //$cuantos=$queryDetalles->count();
    // $asistieron=$queryDetalles->select(['id'])->andWhere(['asistio'=>'1'])->count();
         return false;       
    return (($existe or $cienporcien) and $this->nAlumnos() >0);
 }
 
 public function nAsistencias(){
    return $this->getDetalles()->where(['asistio'=>'1'])->count(); 
 }
 public function nAlumnos(){
    return $this->getDetalles()->count(); 
 }
 
}
