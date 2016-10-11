<?php 
/**
* 
*/
class UsersController extends AppController
{ 
  public $components = array('Paginator');

  var $paginate = array(
    'limit' => 1
    );
  public function index()
  {
    $this->layout = false;
    $getNumber = substr(sha1(mt_rand()),17,5);
    $this->set(compact('getNumber'));
  }
  public function home()
  {
   $this->layout = false;
   if(!$this->Session->check('User.email_address')){
    $this->Flash->error('You do not have access to that location', array('key' => 'loginAuth'));
    $this->redirect(array('action' =>'login'));
  }
}
public function viewTransactions()
{
  $this->layout = false;
  if(!$this->Session->check('User.email_address')){
    $this->Flash->error('You do not have access to that location', array('key' => 'loginAuth'));
    $this->redirect(array('action' =>'login'));
  }
  $this->User->Payment->Behaviors->load('Containable');
  $email_address = $this->Session->read('User.email_address');
  $query_options = array(
    'fields' => array(
      'Payment.licence_category',
      'Payment.licence_id',
      'Payment.subscription_plan',
      'Payment.paid_date',
      'Payment.renewal_date',
      'Payment.amount_paid',
      'Payment.duration',
      'Payment.number_of_vehicles',
      'Payment.number_of_centres'
      ),
    'contain' => array(
      'User' => array(
        'fields' => array(
         'User.company_name',
         'User.contact_person',
         'User.email_address',
         'User.phone_number',
         ),
        ),
      ),
    'conditions' => array('email_address' => $email_address),
    );
  $query = $this->User->Payment->find('all', $query_options);
  $this->set("users", $query);
}
public function login()
{
 $this->layout = false;
 if($this->Session->check('User.email_address')){
  $this->redirect(array('action' =>'home'));
}
if($this->request->is('post')){
  $email_address = $_POST['email_address'];
  App::uses('SimplePasswordHasher','Controller/Component/Auth');
  $passwordHasher = new SimplePasswordHasher(array('hashType' =>'sha256'));
  $password = $passwordHasher->hash($_POST['password']);
  $conditions = array(
    'User.email_address' => $email_address,
    'User.password' => $password);
  if($this->User->hasAny($conditions)){
    $data = $this->User->find('all', array('fields' => array(
      'User.email_address', 'User.contact_person', 'User.phone_number', 'User.company_name', 'User.users_id'),  'conditions' => array(
      'User.email_address' => $email_address,
      'User.password' => $password)));
    foreach($data as $details){
      $contact_person = $details['User']['contact_person'];
      $phone_number =  $details['User']['phone_number'];
      $company_name =  $details['User']['company_name'];
      $email = $details['User']['email_address'];
      $users_id = $details['User']['users_id'];
      $this->Session->write(array(
        'User.phone_number' => $phone_number,
        'User.company_name' => $company_name,
        'User.email_address' => $email,
        'User.contact_person' => $contact_person,
        'User.users_id' => $users_id));
    }
    $this->redirect(array('action'=> 'home'));
  }
  else{
    $this->Flash->error('Invalid username or password, try again', array('key' => 'loginError'));
  }
}
}
public function profile()
{
  $this->layout = false;
  if(!$this->Session->check('User.email_address')){
    $this->Flash->error('You do not have access to that location', array('key' => 'loginAuth'));
    $this->redirect(array('action' =>'login'));
  }
}
public function forgotPassword(){
  $this->layout = false;
  if($this->request->is('post')){
    $this->loadModel('User');
    $email = $this->request->data['User']['email_address'];
    $data = $this->User->findByEmail_address($email);
    $subject = 'Password reset instructions from';
    if(!$data){
      $this->Flash->error('No such email address registered with us', array('key' => 'errorEmailNotReg'));
      $this->redirect(array('action' =>'forgotPassword'));  
    }
    else{
      $key = $data['User']['resetkey'];
      $id = $data['User']['users_id'];
      App::uses('CakeEmail', 'Network/Email');
      $Email = new CakeEmail();
      $Email->config('smtp');
      $Email->emailFormat('html');
      $Email->from(array('oluwafemiakinde@gmail.com' => 'COSON Licence Application Portal'));
      $Email->to($email);
      $Email->viewVars(array('key' => $key, 'id' => $id, 'username' =>$email, 'rand' => mt_rand()));
      $Email->subject($subject);
      $Email->template('forgot_password', null);
        //$Email->send($message);
      if($Email->send('forgot_password')){
       $this->Flash->error('Please check your mailbox', array('key' => 'successEmail'));
     }
     else{
       $this->Flash->error('Oops! Something went wrong. Please try again.', array('key' => 'errorEmail'));
     }
   }
 }
}
public function signUp()
{
  $this->layout = false;
  if($this->request->is('post')){
   if(!empty($this->data)){
    $this->loadModel('User');
    $this->loadModel('Payment');
    $this->User->create();
    // if($this->User->Payment->saveAll($this->request->data)){
    //   $lastID = $this->User->id;
    //   $this->Payment->create();
    //   $this->request->data['Payment']['users_id'] = $lastID;
    //   $this->User->Payment->saveAll($this->request->data);
    //   $this->redirect(array('action' => 'index'));
    // }
    $users_id_session = $this->Session->read('User.users_id');
    // $this->User->id = $users_id;
    $users_id = $this->User->findByUsers_id($users_id_session);
    if(!$users_id){
      $this->User->Payment->saveAll($this->request->data);
      $this->redirect(array('action' => 'index'));
    }
    else
   // else if($users_id){
// $arrayToSave['User']['email_address'] = $this->request->data['User']['email_address'];
// $arrayToSave['User']['contact_person'] = $this->request->data['User']['contact_person'];
// $arrayToSave['User']['company_name'] = $this->request->data['User']['company_name'];
// $arrayToSave['User']['phone_number'] = $this->request->data['User']['phone_number'];
// $arrayToSave['User']['password'] = $this->request->data['User']['password'];
      $email_address = $this->request->data['User']['email_address'];
    $contact_person = $this->request->data['User']['contact_person'];
    $phone_number = $this->request->data['User']['phone_number'];
    $password = $this->request->data['User']['password'];
    $company_name = $this->request->data['User']['company_name'];
    //$this->User->id = $users_id;
// $this->User->updateAll(array(
//   'User.company_name' => $company_name,
//   'User.contact_person' => $contact_person,
//   'User.email_address' => $email_address,
//   'User.phone_number' => $phone_number,
//   'User.password' => $password
//   ), array(
//   'User.users_id' => $users_id_session));
    // $this->User->read(null, $users_id);
    // $this->User->set(array(
    //   'User.company_name' => $company_name,
    //   'User.contact_person' => $contact_person,
    //   'User.email_address' => $email_address,
    //   'User.phone_number' => $phone_number,
    //   'User.password' => $password
    //   ));
    $this->User->updateAll(
    array(
      'company_name' => "'$company_name'",
      'contact_person' => "'$contact_person'",
      'email_address' => "'$email_address'",
      'phone_number' => "'$phone_number'",
      'password' => "'$password'"
      ),
    array('email_address' => $email_address)
);
    $this->User->save();
    $this->User->id = $users_id;
    $this->Payment->save();
    $this->redirect(array('action' => 'index'));
  //}
  }
}
}
public function logout()
{
 $this->Session->destroy();
 $this->Flash->error('You have successfully logged out.', array('key' => 'loginOut'));
 $this->redirect(array('action' => 'login'));
}
}