<?php 
class HomeController extends AppController
{
	public $uses = array('User');
	public function index(){
		$this->layout = false;
	}
	public function signUp(){
	if($this->request->is('post')){
			if(!empty($this->data)){
			if($this->request->is('post')){
				$this->User->create();
				$this->User->save($this->request->data);
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	}
	public function signIn(){
		$this->layout = false;
		if($this->request->is('post')){
					$email_address = $_POST['email_address'];
		$password = $_POST['password'];
		$conditions = array('User.email_address' => $email_address,
			'User.password' => $password);
		if($this->User->hasAny($conditions)){
			$this->Session->write('User.email_address', $email_address);
			$this->redirect(array('controller' => 'users', 'action'=>'index'));
		}
		else{
			$this->Flash->error('Invalid username or password, try again', array('key' => 'loginError'));
			$this->redirect(array('controller' => 'users', 'action'=>'login'));
		}
	}
		}
}