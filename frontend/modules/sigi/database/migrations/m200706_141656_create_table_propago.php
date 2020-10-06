<?php

namespace frontend\modules\sigi\database\migrations;

//use yii\db\Migration;
use console\migrations\baseMigration;
class m200706_141656_create_table_propago extends baseMigration
{
    const NAME_TABLE='{{%sigi_propago}}';
   const NAME_TABLE_PORPAGAR='{{%sigi_porpagar}}';
   const NAME_TABLE_EDIFICIO='{{%sigi_edificios}}';
  // const NAME_TABLE_CUENTAS='{{%sigi_cuentas}}';
      //const NAME_TABLE_GRUPOS='{{%sigi_cargosgrupoedificio}}';
       //const NAME_TABLE_CUENTASPOR='{{%sigi_cuentaspor}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->bigPrimaryKey(),
        'porpagar_id'=>$this->bigInteger(20)->notNull(),
        'edificio_id'=>$this->integer(11)->notNull(),
          'fechaprog'=>$this->char(3)->notNull()->append($this->collateColumn()),
        'nivel'=>$this->char(1)->notNull()->append($this->collateColumn()),
         'cuenta'=>$this->string(30)->notNull()->append($this->collateColumn()),
        'cci'=>$this->string(12)->notNull()->append($this->collateColumn()),
        'codestado'=>$this->char(2)->notNull()->append($this->collateColumn()),
        
        ],$this->collateTable());
  $this->addForeignKey($this->generateNameFk($table), $table,
              'edificio_id', static::NAME_TABLE_EDIFICIO,'id'); 
  $this->addForeignKey($this->generateNameFk($table), $table,
              'porpagar_id', static::NAME_TABLE_PORPAGAR,'id'); 
    
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
