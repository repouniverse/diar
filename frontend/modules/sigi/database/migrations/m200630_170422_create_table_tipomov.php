<?php
namespace frontend\modules\sigi\database\migrations;

//use yii\db\Migration;
use console\migrations\baseMigration;
/**
 * Class m200127_191555_create_table_kardexdepa
 */
use yii;
class m200630_170422_create_table_tipomov extends baseMigration
{
    const NAME_TABLE='{{%sigi_tipomov}}';
  // const NAME_TABLE_UNIDADES='{{%sigi_unidades}}';
  // const NAME_TABLE_EDIFICIO='{{%sigi_edificios}}';
   //const NAME_TABLE_COLECTORES='{{%sigi_cargosedificio}}';
      //const NAME_TABLE_GRUPOS='{{%sigi_cargosgrupoedificio}}';
       //const NAME_TABLE_CUENTASPOR='{{%sigi_cuentaspor}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
      'codigo'=>$this->char(3),//$this->primaryKey(20),
      'descripcion'=>$this->string(40)->append($this->collateColumn()),        
        ],$this->collateTable());
  $this->addPrimaryKey($this->generateNameFk($table), $table,'codigo');
   /* $this->addForeignKey($this->generateNameFk($table), $table,
              'unidad_id', static::NAME_TABLE_UNIDADES,'id');*/
    
            } 
 }

public function safeDown()
    {
     $table=static::NAME_TABLE;
       if($this->existsTable($table)) {
            $this->dropTable($table);
        }

    }

}
