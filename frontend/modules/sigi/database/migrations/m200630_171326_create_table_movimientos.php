<?php
namespace frontend\modules\sigi\database\migrations;

//use yii\db\Migration;
use console\migrations\baseMigration;
/**
 * Class m200127_191555_create_table_kardexdepa
 */
use yii;
class m200630_171326_create_table_movimientos extends baseMigration
{
    const NAME_TABLE='{{%sigi_movimientos}}';
   const NAME_TABLE_TIPOMOV='{{%sigi_tipomov}}';
   const NAME_TABLE_EDIFICIO='{{%sigi_edificios}}';
   const NAME_TABLE_CUENTAS='{{%sigi_cuentas}}';
      //const NAME_TABLE_GRUPOS='{{%sigi_cargosgrupoedificio}}';
       //const NAME_TABLE_CUENTASPOR='{{%sigi_cuentaspor}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->bigPrimaryKey(20),
        'idop'=>$this->bigInteger(20),
         'edificio_id'=>$this->integer(11)->notNull(),
         'kardex_id'=>$this->integer(11),
         'cuenta_id'=>$this->integer(11)->notNull(),
          'fechaop'=>$this->string(10)->notNull()->append($this->collateColumn()),
         'fechaprog'=>$this->string(10)->notNull()->append($this->collateColumn()),
        
        'fechacre'=>$this->string(19)->notNull()->append($this->collateColumn()),
         'tipomov'=>$this->char(3)->notNull()->append($this->collateColumn()),
         'glosa'=>$this->string(40)->notNull()->append($this->collateColumn()),
        'monto'=>$this->decimal(12,3)->notNull(),
         'igv'=>$this->decimal(8,3)->notNull(),
        'monto_usd'=>$this->decimal(12,3)->notNull(),
        'user_id'=>$this->integer(4),
        'activo'=>$this->char(1)->notNull()->append($this->collateColumn()),
        ],$this->collateTable());
  
   /* $this->addForeignKey($this->generateNameFk($table), $table,
              'unidad_id', static::NAME_TABLE_UNIDADES,'id');*/
    $this->addForeignKey($this->generateNameFk($table), $table,
              'tipomov', static::NAME_TABLE_TIPOMOV,'codigo'); 
    
 $this->addForeignKey($this->generateNameFk($table), $table,
              'cuenta_id', static::NAME_TABLE_CUENTAS,'id'); 
 
             
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
