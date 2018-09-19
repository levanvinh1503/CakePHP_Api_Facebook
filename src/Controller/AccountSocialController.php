<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\View\View;
use Cake\Network\Session\DatabaseSession;

/**
 * AccountSocial Controller
 *
 * @property \App\Model\Table\AccountSocialTable $AccountSocial
 *
 * @method \App\Model\Entity\AccountSocial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccountSocialController extends AppController
{
    /**
     * initialization function
     */
    public function initialize()
    {
        parent::initialize();
        //Load FunctionLb
        $this->loadComponent('FunctionLb');
        //Set authentication
        $this->set('Auth', $this->Auth);
    }

    /**
     * Display login page
     * @return \Cake\Http\Response|void
     */
    public function login()
    {
        //Log out of your account when you return to the login page
        $this->Auth->logout();
        //Set layout
        $this->viewBuilder()->setLayout('login');
    }

    /**
     * Login with api facebook
     * @return \Cake\Http\Response|void
     */
    public function loginFacebook()
    {
        //Get token
        $accessToken = $this->request->getQuery('access_token');
        $this->request->session()->write('token', $accessToken);
        //Connect API Facebook
        $facebookObj = $this->FunctionLb->connectApi();
        //Get infomation of user
        $getInfo = $this->FunctionLb->getInfo($facebookObj, $accessToken);
        $arrayAccount = [
            'id' => $getInfo['id'],
            'name_account' => $getInfo['name'],
            'email_account' => $getInfo['email']
        ];
        //Save data user into database
        $this->FunctionLb->saveData($this->loadModel('AccountSocial'), $arrayAccount, $getInfo['id']);
        //Save data friend into database
        $this->FunctionLb->loadFriend($facebookObj, $this->loadModel('FriendSocial'), $accessToken, $getInfo['id']);
        //Save data post into database
        $this->FunctionLb->loadPost($facebookObj, $this->loadModel('PostSocial'), $accessToken, $getInfo['id']);
        //Login user
        $this->Auth->setUser($getInfo);

        //Redirect dashboard page
        return $this->redirect(['controller' => 'AccountSocial', 'action' => 'dashBoard', 'id' => $getInfo['id']]);
    }

    /**
     * Display dashboard page
     * @param  string $idAccount
     * @return \Cake\Http\Response|void
     */
    public function dashBoard($idAccount = null)
    {
        //Get token
        $accessToken = $this->request->session()->read('token');
        //Connect API Facebook
        $facebookObj = $this->FunctionLb->connectApi();
        //Save data friend into database
        $this->FunctionLb->loadFriend($facebookObj, $this->loadModel('FriendSocial'), $accessToken, $idAccount);
        //Save data post into database
        $this->FunctionLb->loadPost($facebookObj, $this->loadModel('PostSocial'), $accessToken, $idAccount);
        //Load friend model
        $friendModel = $this->loadModel('FriendSocial');
        //Count the friend list with id is $ idAccount
        $friendSocial = $friendModel->find()->where(['id_account' => $idAccount])->count();
        //Load post model
        $postModel = $this->loadModel('PostSocial');
        //Count the article list with id is $ idAccount
        $postSocial = $postModel->find()->where(['id_account' => $idAccount])->count();
        //Set Layout
        $this->viewBuilder()->setLayout('dashboard');

        $this->set(compact('friendSocial', 'postSocial', 'idAccount'));
    }

    /**
     * List of user friends
     * @param  string $idAccount
     * @return \Cake\Http\Response|void
     */
    public function listFriend($idAccount = null)
    {
        //Get token
        $accessToken = $this->request->session()->read('token');
        //Connect API Facebook
        $facebookObj = $this->FunctionLb->connectApi();
        //Save data friend into database
        $this->FunctionLb->loadFriend($facebookObj, $this->loadModel('FriendSocial'), $accessToken, $idAccount);
        //Use layout Layout/dashboard.ctp
        $this->viewBuilder()->setLayout('dashboard');
        //Load model Category
        $friendModel = $this->loadModel('FriendSocial');
        $arrayFriend = $this->paginate($friendModel->find(), [
            'limit' => 5
        ]);
        //Set data to view
        $this->set(compact('arrayFriend', 'idAccount'));
    }

    /**
     * List of user posts
     * @param  string $idAccount
     * @return \Cake\Http\Response|void
     */
    public function listPost($idAccount = null)
    {
        //Get token
        $accessToken = $this->request->session()->read('token');
        //Connect API Facebook
        $facebookObj = $this->FunctionLb->connectApi();
        //Save data post into database
        $this->FunctionLb->loadPost($facebookObj, $this->loadModel('PostSocial'), $accessToken, $idAccount);
        //Use layout Layout/dashboard.ctp
        $this->viewBuilder()->setLayout('dashboard');
        //Load model Category
        $postModel = $this->loadModel('PostSocial');
        $arrayPost = $this->paginate($postModel->find(), [
            'limit' => 5
        ]);
        //Set data to view
        $this->set(compact('arrayPost', 'idAccount'));
    }
}
