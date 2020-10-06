<?php
namespace frontend\modules\sigi\database\migrations;

//use yii\db\Migration;
use console\migrations\baseMigration;
class m200708_192124_create_table_movbanco extends baseMigration
{
    const NAME_TABLE='{{%sigi_movbanco}}';
   const NAME_TABLE_CUENTAS='{{%sigi_cuentas}}';
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
        'cuenta_id'=>$this->integer(11)->notNull(),
        'edificio_id'=>$this->integer(11)->notNull(),
          'fopera'=>$this->char(10)->notNull()->append($this->collateColumn()),
         'fval'=>$this->char(10)->notNull()->append($this->collateColumn()),
         'monto'=>$this->decimal(10,3)->notNull(),
        'noper'=>$this->integer(11),
        'descripcion'=>$this->string(30)->append($this->collateColumn()),
        
        
        ],$this->collateTable());
  $this->addForeignKey($this->generateNameFk($table), $table,
              'edificio_id', static::NAME_TABLE_EDIFICIO,'id'); 
  $this->addForeignKey($this->generateNameFk($table), $table,
              'cuenta_id', static::NAME_TABLE_CUENTAS,'id'); 
    
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
