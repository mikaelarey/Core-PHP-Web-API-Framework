<?php

namespace Repository\Repositories;

use Doctrine\ORM\Query\ResultSetMapping;
use Repository\Models\UserAccount;
use Repository\Setup\OrmSetup;

class UserAccountRepository {
    public function __construct() {
        $this->orm = new OrmSetup();
        $this->user_entity = 'Repository\Models\UserAccount';
    }

    public function login($username, $password) {
        $qb = $this->orm->entityManager->createQueryBuilder();

        return $qb->select('ua')
                  ->from($this->user_entity, 'ua')
                  ->where('ua.username = :username')
                  ->andWhere('ua.password = :password')
                  ->setMaxResults(1)
                  ->setParameter('username', $username)
                  ->setParameter('password', $password)
                  ->getQuery()
                  ->getOneOrNullResult();
    }

    public function get_by_id($id) {
        return $this->orm->entityManager->find(UserAccount::class, $id);
    }

    public function get_all() {
        $qb = $this->orm->entityManager->getRepository(UserAccount::class);
        return $category->findAll();
    }

    public function get_by_email($email) {
        $qb = $this->orm->entityManager->getRepository(UserAccount::class);
        return $qb->findOneBy(['email' => $email]);
    }

    private function build_json_data(UserAccount $user) {
        $data = [
            'id' => $user->get_id(),
            'firstname' => $user->get_firstname(),
            'middlename' => $user->get_middlename(),
            'lastname' => $user->get_lastname(),
            'username' => $user->get_username(),
            'email' => $user->get_email(),
            'user_role_id' => $user->get_user_role_id()
        ];

        return json_encode($data);
    }

    private function get_table_name() {
        $metadata = $this->orm->entityManager->getClassMetadata(UserAccount::class);
        return $metadata->getTableName();
    }
}
?>