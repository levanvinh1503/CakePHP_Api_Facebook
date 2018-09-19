<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FriendSocial Entity
 *
 * @property string $id
 * @property string $name_friend
 * @property string $id_account
 */
class FriendSocial extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id' => true,
        'name_friend' => true,
        'id_account' => true
    ];
}
