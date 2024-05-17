<?php

namespace Repository\Seeds;

use Doctrine\ORM\Query\ResultSetMapping;
use Repository\Models\UserAccount;

class UserAccountSeed {
    public $user_accounts = [1];

    public function __construct($entity_manager) {
        $this->entity_manager = $entity_manager;
        $this->entity_name    = 'Repository\Models\UserAccount';
        $this->query_builder  = $this->entity_manager->createQueryBuilder();
    }

    public function seed_data() {
        $this->create_user_accounts();
    }

    private function get_user_accounts() {
        $this->query_builder->select('s')
                            ->from($this->entity_name, 's')
                            ->where($this->query_builder->expr()->in('s.user_role_id', ':user_accounts'))
                            ->setParameter('user_accounts', $this->user_accounts);

        $query = $this->query_builder->getQuery();
        return $query->getResult();
    }

    private function create_user_accounts() {
        $user_accounts = $this->get_user_accounts();

        if (empty($user_accounts)) {
            $user_account = $this->build_user_account();
            $this->entity_manager->persist($user_account);

            $this->entity_manager->flush();
        }
    }

    private function build_user_account() {
        $user_account = new UserAccount();
        $user_account->set_firstname('Admin');
        $user_account->set_middlename('Ako');
        $user_account->set_lastname('Account');
        $user_account->set_username('ADM0001');
        $user_account->set_password('P@$$w0rd');
        $user_account->set_email('admin@gmail.com');
        $user_account->set_user_role_id(1);

        return $user_account;
    }
}

?>