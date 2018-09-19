<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AccountSocial Model
 *
 * @method \App\Model\Entity\AccountSocial get($primaryKey, $options = [])
 * @method \App\Model\Entity\AccountSocial newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AccountSocial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AccountSocial|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AccountSocial|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AccountSocial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AccountSocial[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AccountSocial findOrCreate($search, callable $callback = null, $options = [])
 */
class AccountSocialTable extends Table
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

        $this->setTable('account_social');
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
            ->scalar('name_account')
            ->maxLength('name_account', 255)
            ->requirePresence('name_account', 'create')
            ->notEmpty('name_account');

        $validator
            ->scalar('email_account')
            ->maxLength('email_account', 255)
            ->allowEmpty('email_account');

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
