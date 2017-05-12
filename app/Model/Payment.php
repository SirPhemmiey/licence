<?php 
/**
* 
*/
class Payment extends AppModel
{
  public $primaryKey = 'payment_id';
  public $belongsTo = array(
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'users_id')
      // 'foreignKey' => 'users_id')
    ); 
  public function beforeSave($options = array()){
      $this->data[$this->alias]['paid_date'] = date("Y-m-d H:i:s");
      return true;
  }
}