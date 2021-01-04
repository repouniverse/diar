<?php
namespace frontend\modules\sigi\components;
use frontend\modules\sigi\models\SigiUserEdificios;
use frontend\modules\sta\staModule;
use common\helpers\h;
use frontend\modules\sigi\components\ActiveQueryScope;
/* 
 * Esta clase es la que efectua los filtros por facultad segun 
 * el perfil del ususario; es decir 
 * cualquier persona no puede visulaizar registros de otras facultades
 * por convencion el campo de criterio es el campo
 * "codfac" 
 */
class ActiveQueryStatusScope extends ActiveQueryScope
{
    
 public function init()
    {
      //var_dump(UserFacultades::filterFacultades());die();
       //$this->andWhere([ 'in', 'codfac',['FIM','FIP'] ]);
      $this->andWhere([
              'activo'=> '1'
               ]);
        parent::init();
    }
    // HOLA MODIFICANDO

   
    
   public function complete(){
       return  $this->orWhere(['in',
              'codfac',Facultades::find()->select('codfac')->asArray()->all()
               ]);
   }
    
}

