<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * FunctionLb component
 */
class FunctionLbComponent extends Component
{
    /**
     * Connect API facebook
     * @return object
     */
    public function connectApi()
    {
        //Connect API facebook
        $facebookObj = new \Facebook\Facebook([
           'app_id' => FACEBOOK_APP_ID,
           'app_secret' => FACEBOOK_APP_SECRET,
           'default_graph_version' => 'v3.1',
       ]);

        return $facebookObj;
    }

    /**
     * Get infomation of account facebook
     * @param object $facebookObj
     * @param string $accessToken
     * @return array
     */
    public function getInfo($facebookObj, $accessToken)
    {
        $getInfo = $facebookObj->get('/me?fields=id,name,email', $accessToken);
        $graphNode = $getInfo->getGraphNode();

        return $graphNode;
    }

    /**
     * Get infomation of account facebook
     * @param object $facebookObj
     * @param string $idAccount
     * @param string $accessToken
     * @return array
     */
    public function getUserInfo($facebookObj, $idAccount, $accessToken)
    {
        $getInfo = $facebookObj->post('/' . $idAccount, ['fields' => 'id,name,email,gender,birthday,picture'], $accessToken);
        $graphNode = $getInfo->getGraphNode();

        return $graphNode;
    }

    /**
     * Get list friend of account facebook
     * @param object $facebookObj
     * @param string $accessToken
     * @param string $idAccount
     * @return object
     */
    public function getFriend($facebookObj, $accessToken, $idAccount)
    {
        $getFriend = $facebookObj->get('/' . $idAccount . '/friends?fields=id,name,email', $accessToken);
        $graphFriend = $getFriend->getGraphEdge();

        return $graphFriend;
    }

    /**
     * Get list post of account facebook
     * @param object $facebookObj
     * @param string $accessToken
     * @param string $idAccount
     * @return object
     */
    public function getPost($facebookObj, $accessToken, $idAccount)
    {
        $getPosts = $facebookObj->get('/' . $idAccount . '/feed?fields=id,message,picture,created_time', $accessToken);
        $graphPosts = $getPosts->getGraphEdge();

        return $graphPosts;
    }

    /**
     * Save data into database
     * @param object $friendModel
     * @param array $arrayData
     * @param string $idPost
     */
    public function saveData($friendModel, $arrayData, $idPost)
    {   
        $newEntity = $friendModel->newEntity($arrayData);
        $patchEntity = $friendModel->patchEntity($newEntity, $arrayData);
        //If data is not saved then the data can be updated
        if (!$friendModel->save($patchEntity)) {
            $editPost = $friendModel->get($idPost, [
                'contain' => []
            ]);
            $patchEntityEdit = $friendModel->patchEntity($editPost, $arrayData);
            //Save data into database
            $friendModel->save($patchEntityEdit);
        }
    }

    /**
     * Save post list to database 
     * @param object $facebookObj
     * @param object $postModel
     * @param string $accessToken
     * @param string $idAccount
     */
    public function loadPost($facebookObj, $postModel, $accessToken, $idAccount)
    {
        //Get list of user post
        $getPost = $this->getPost($facebookObj, $accessToken, $idAccount);
        //Save data post into database
        foreach ($getPost as $keyPost => $valuePost) {
            $picturePost = '';
            $messagePost = '';
            //Check isset picture
            if (isset($valuePost['picture'])) {
                $picturePost = $valuePost['picture'];
            }
            //Check isset message
            if (isset($valuePost['message'])) {
                $messagePost = $valuePost['message'];
            }
            $arrayPost = [
                'id' => $valuePost['id'],
                'message' => $messagePost,
                'picture' => $picturePost,
                'id_account' => $idAccount,
                'created_at' => $valuePost['created_time']
            ];
            //Call function save data
            $this->saveData($postModel, $arrayPost, $valuePost['id']);
        }
    }

    /**
     * Save friend list to database
     * @param object $facebookObj
     * @param object $friendModel
     * @param string $accessToken
     * @param string $idAccount
     */
    public function loadFriend($facebookObj, $friendModel, $accessToken, $idAccount)
    {
        //Get list of user friend
        $getFriend = $this->getFriend($facebookObj, $accessToken, $idAccount);
        //Save data friend into database
        foreach ($getFriend as $keyFriend => $valueFriend) {
            $arrayFriend = [
                'id' => $valueFriend['id'] . '_' . $idAccount,
                'name_friend' => $valueFriend['name'],
                'id_account' => $idAccount
            ];
            //Call function save data
            $this->saveData($friendModel, $arrayFriend, $valueFriend['id'] . '_' . $idAccount);
        }
    }
}
