<?php 

/**
* 
*/
class TransportersController extends AppController
{
  public function index(){
    $this->layout = false;
    $getNumber = substr(sha1(mt_rand()),17,5);
    $this->set(compact('getNumber'));
  }
  public function home(){
    $this->layout = false;
    if(!$this->Session->check('Transporter.email')){
      $this->Flash->error('You do not have access to that location', array('key' => 'loginAuth'));
      $this->redirect(array('action' =>'login'));
    }
    $transporters = $this->Transporter->find('all');
    $this->set('transporters', $transporters);
  }
  public function profile(){
    $this->layout = false;
  }
 public function signUp()
{
  $this->layout = false;
  if($this->request->is('post')){
   if(!empty($this->data)){
   // $this->loadModel(array('Payment', 'Transporter'));
    //$this->Transporter->create();
    // if($this->Transporter->save($this->request->data) && $this->Payment->save($this->request->data)){
    //   $this->redirect(array('action' => 'index'));
    // }
    if($this->Transporter->saveAll($this->data)){
      $this->redirect(array('action' => 'index'));
    }
  }
}
}
  public function login(){
    $this->layout = false;
    if($this->Session->check('Transporter.email')){
      $this->redirect(array('action' =>'home'));
    }
    if($this->request->is('post')){
      $email = $_POST['email'];$this->set('email', $email);
      App::uses('SimplePasswordHasher','Controller/Component/Auth');
        $passwordHasher = new SimplePasswordHasher(array('hashType' =>'sha256'));
        $password = $passwordHasher->hash($_POST['password']);
      $conditions = array(
        'Transporter.email' => $email,
        'Transporter.password' => $password);
      if($this->Transporter->hasAny($conditions)){
        $data = $this->Transporter->find('all', array('fields' => array(
          'Transporter.email', 'Transporter.full_name', 'Transporter.phone_number', 'Transporter.password'),  'conditions' => array(
          'Transporter.email' => $email,
          'Transporter.password' => $password)));
        foreach($data as $details){
         $phone_number =  $details['Transporter']['phone_number'];
         $full_name =  $details['Transporter']['full_name'];
         $email = $details['Transporter']['email'];
         $this->Session->write(array(
          'Transporter.phone_number' => $phone_number,
          'Transporter.full_name' => $full_name,
          'Transporter.email' => $email));
       }
       $this->redirect(array('action'=> 'home'));
     }
     else{
      $this->Flash->error('Invalid username or password, try again', array('key' => 'loginError'));
    }
  }
}
public function logout(){
 $this->Session->destroy();
 $this->Flash->error('You have successfully logged out', array('key' => 'loginOut'));
 $this->redirect(array('controller' => 'transporters', 'action' => 'login'));
}
public function viewTransactions(){
  $this->layout = false;
  //$this->loadModel('Transporter');
  $transporters = $this->Transporter->find('all');
  $this->set(compact('transporters'));
}
public function vehicleMonth(){
  $this->layout = false;
  $this->request->onlyAllow('ajax');
  if($this->request->is('post')){
    if($this->request->is('ajax')){
      $duration = $_POST['value'];
      $duration = $this->Session->write('duration', $duration);
    }
  }
}
public function vehicleMonthDestroy(){
  $this->request->onlyAllow('ajax');
  if($this->request->is('post')){
    if($this->request->is('ajax')){
      //$dura = $_POST['value'];
      $this->Session->destroy('duration');
    }
  }
}
}