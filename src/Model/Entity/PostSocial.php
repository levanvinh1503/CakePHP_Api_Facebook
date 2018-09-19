<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PostSocial Entity
 *
 * @property string $id
 * @property string $message
 * @property string $picture
 * @property string $id_account
 * @property \Cake\I18n\FrozenTime $created_at
 */
class PostSocial extends Entity
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
        'message' => true,
        'picture' => true,
        'id_account' => true,
        'created_at' => true
    ];
}
