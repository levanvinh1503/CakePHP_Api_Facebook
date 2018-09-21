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
        return $this->redirect(['controller' => 'AccountSocial', 'action' => 'dashBoard']);
    }

    /**
     * Display dashboard page
     * @param  string $idAccount
     * @return \Cake\Http\Response|void
     */
    public function dashBoard()
    {
        //Connect API Facebook
        $facebookObj = $this->FunctionLb->connectApi();
        //Get id account login
        $idAccount = $this->Auth->user('id');
        //Get token
        $accessToken = $facebookObj->getApp()->getAccessToken()->getValue();
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

        $this->set(compact('friendSocial', 'postSocial'));
    }

    /**
     * List of user friends
     * @param  string $idAccount
     * @return \Cake\Http\Response|void
     */
    public function listFriend()
    {
        //Connect API Facebook
        $facebookObj = $this->FunctionLb->connectApi();
        //Get id account login
        $idAccount = $this->Auth->user('id');
        //Get token
        $accessToken = $facebookObj->getApp()->getAccessToken()->getValue();
        //Connect API Facebook
        $facebookObj = $this->FunctionLb->connectApi();
        //Save data friend into database
        $this->FunctionLb->loadFriend($facebookObj, $this->loadModel('FriendSocial'), $accessToken, $idAccount);
        //Use layout Layout/dashboard.ctp
        $this->viewBuilder()->setLayout('dashboard');
        //Load model Category
        $friendModel = $this->loadModel('FriendSocial');
        //Get the keyword "search"
        $keySearch = trim($this->request->getQuery('search'), '%');
        //Set keyword
        $keyWord = '%' . $keySearch . '%';
        //Get, set keyword submit form search
        if ($this->request->is(['post'])) {
            $keySearch = $this->request->getData('search');
            $keyWord = '%' . $keySearch . '%';
        }

        //Search by keyword
        $arrayFriend = $this->paginate($friendModel->find()->where([
            'id_account' => $idAccount,
            'OR' => [
                'id LIKE' => $keyWord,
                'name_friend LIKE' => $keyWord
            ]
        ]), [
            'limit' => FRIEND_LIMIT,
            'contain' => []
        ]);

        //Redirect page with keyword
        if ($this->request->is(['post'])) {
            $this->redirect(['controller' => 'AccountSocial', 'action' => 'listFriend', 'search' => $keyWord]);
            $this->set(compact('arrayFriend', 'keySearch'));
        }
        //Set data to view
        $this->set(compact('arrayFriend', 'keySearch'));
    }

    /**
     * List of user posts
     * @param  string $idAccount
     * @return \Cake\Http\Response|void
     */
    public function listPost()
    {
        //Connect API Facebook
        $facebookObj = $this->FunctionLb->connectApi();
        //Get id account login
        $idAccount = $this->Auth->user('id');
        //Get token
        $accessToken = $facebookObj->getApp()->getAccessToken()->getValue();
        //Connect API Facebook
        $facebookObj = $this->FunctionLb->connectApi();
        //Save data post into database
        $this->FunctionLb->loadPost($facebookObj, $this->loadModel('PostSocial'), $accessToken, $idAccount);
        //Use layout Layout/dashboard.ctp
        $this->viewBuilder()->setLayout('dashboard');
        //Load model Category
        $postModel = $this->loadModel('PostSocial');
        //Get the keyword "search"
        $keySearch = trim($this->request->getQuery('search'), '%');
        //Set keyword
        $keyWord = '%' . $keySearch . '%';
        //Get, set keyword submit form search
        if ($this->request->is(['post'])) {
            $keySearch = $this->request->getData('search');
            $keyWord = '%' . $keySearch . '%';
        }

        //Search by keyword
        $arrayPost = $this->paginate($postModel->find()->where([
            'id_account' => $idAccount,
            'OR' => [
                'id LIKE' => $keyWord,
                'message LIKE' => $keyWord
            ]
        ]), [
            'limit' => POST_LIMIT,
            'contain' => []
        ]);

        //Redirect page with keyword
        if ($this->request->is(['post'])) {
            $this->redirect(['controller' => 'AccountSocial', 'action' => 'listPost', 'search' => $keyWord]);
            $this->set(compact('arrayPost', 'keySearch'));
        }
        //Set data to view
        $this->set(compact('arrayPost', 'keySearch'));
    }

    /**
     * View detailed friend information
     * @param  string $idFriend
     * @return \Cake\Http\Response|void
     */
    public function detailFriend($idFriend = null)
    {
        //Connect API Facebook
        $facebookObj = $this->FunctionLb->connectApi();
        //Get id account login
        $idAccount = $this->Auth->user('id');
        //Get token
        $accessToken = $facebookObj->getApp()->getAccessToken()->getValue();
        //Load model Friend
        $friendModel = $this->loadModel('FriendSocial');
        //Set layout
        $this->viewBuilder()->setLayout('dashboard');
        //Get user infomation with id = idFriend
        $getFriend = $friendModel->get($idFriend.'_'.$idAccount, [
            'contain' => []
        ]);
        //Check if the user is a friend of the login account
        if ($getFriend->id_account == $idAccount) {
            //Get user infomation
            $getUserInfo = $this->FunctionLb->getUserInfo($facebookObj, $idFriend, $accessToken);
            //Get photo upload
            $getImageUpload = $this->FunctionLb->getPhotoUpload($facebookObj, $idFriend, $this->request->session()->read('token'));
            //Get photo tagged
            $getImageTagged = $this->FunctionLb->getPhotoTagged($facebookObj, $idFriend, $this->request->session()->read('token'));
            $this->set(compact('getUserInfo', 'getImageUpload', 'getImageTagged'));

        } else {
            //Set message error
            $this->Flash->error('Người dùng này không phải là bạn bè của bạn, bạn không có quyền xem thông tin người dùng này. Vui lòng thử lại !', [
                'key' => 'detailFriend',
                'params' => []
            ]);
        }
    }
}
