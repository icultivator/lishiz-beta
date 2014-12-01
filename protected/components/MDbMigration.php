<?php
/**
 * Created by PhpStorm.
 * User: sunqiang3
 * Date: 2014/11/26
 * Time: 11:03
 */
class MDbMigration extends CDbMigration{
    public function createTableBySql($table,$sql){
        echo " > create table $table ...";
        $time=microtime(true);
        $this->getDbConnection()->createCommand($sql)->execute();
        echo " done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";
    }
}