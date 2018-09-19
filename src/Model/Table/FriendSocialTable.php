<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FriendSocial Model
 *
 * @method \App\Model\Entity\FriendSocial get($primaryKey, $options = [])
 * @method \App\Model\Entity\FriendSocial newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FriendSocial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FriendSocial|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FriendSocial|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FriendSocial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FriendSocial[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FriendSocial findOrCreate($search, callable $callback = null, $options = [])
 */
class FriendSocialTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('friend_social');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('id')
            ->maxLength('id', 100)
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name_friend')
            ->maxLength('name_friend', 100)
            ->requirePresence('name_friend', 'create')
            ->notEmpty('name_friend');

        $validator
            ->scalar('id_account')
            ->maxLength('id_account', 100)
            ->requirePresence('id_account', 'create')
            ->notEmpty('id_account');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }
}
