<?php

namespace frontend\modules\sigi\database\migrations;

//use yii\db\Migration;
use console\migrations\baseMigration;

/**
 * Class m200705_230446_create_table_porpagar
 */
class m200705_230446_create_table_porpagar extends baseMigration
{
    const NAME_TABLE='{{%sigi_porpagar}}';
   //const NAME_TABLE_TIPOMOV='{{%sigi_tipomov}}';
   const NAME_TABLE_EDIFICIO='{{%sigi_edificios}}';
  // const NAME_TABLE_CUENTAS='{{%sigi_cuentas}}';
      //const NAME_TABLE_GRUPOS='{{%sigi_cargosgrupoedificio}}';
       //const NAME_TABLE_CUENTASPOR='{{%sigi_cuentaspor}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->bigPrimaryKey(20),
          'codocu'=>$this->char(3)->notNull()->append($this->collateColumn()),
        'edificio_id'=>$this->integer(11)->notNull(),
         'unidad_id'=>$this->integer(11)->notNull(),
        'monto'=>$this->decimal(12,3)->notNull(),
         'igv'=>$this->decimal(8,3)->notNull(),
         'codpresup'=>$this->string(10)->notNull()->append($this->collateColumn()),
        'codmon'=>$this->string(5)->notNull()->append($this->collateColumn()),
         'monto_usd'=>$this->decimal(12,3)->notNull(),
        'glosa'=>$this->string(40)->notNull()->append($this->collateColumn()),
         'fechadoc'=>$this->string(10)->notNull()->append($this->collateColumn()),      
         'codestado'=>$this->char(2)->notNull()->append($this->collateColumn()),
        'detalle'=>$this->text()->append($this->collateColumn()),
        
        ],$this->collateTable());
  
  
     $this->addForeignKey($this->generateNameFk($table), $table,
              'edificio_id', static::NAME_TABLE_EDIFICIO,'id'); 
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
