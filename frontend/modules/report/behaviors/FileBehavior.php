<?php
namespace frontend\modules\report\behaviors;
use common\behaviors\FileBehavior as Fileb;

class FileBehavior extends  Fileb
{
   public function dirFile(){
      \yii::error('Dir file es '.$this->getModule()->getUserDirPath());      
      
       return $this->getModule()->getUserDirPath();
   } 
   
}