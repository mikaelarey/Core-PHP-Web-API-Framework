<?php

namespace Repository\Seeds;

use Doctrine\ORM\Query\ResultSetMapping;
use Repository\Models\UserRole;

class UserRoleSeed {
    private $roles = ['Administrator', 'Associate', 'Approver', 'Student'];

    public function __construct($entity_manager) {
        $this->entity_manager = $entity_manager;
        $this->entity_name    = 'Repository\Models\UserRole';
        $this->query_builder  = $this->entity_manager->createQueryBuilder();
    }

    public function seed_data() {
        $this->create_roles();
    }

    private function get_roles() {
        $this->query_builder->select('r')
                            ->from($this->entity_name, 'r')
                            ->where($this->query_builder->expr()->in('r.name', ':roles'))
                            ->setParameter('roles', $this->roles);

        $query = $this->query_builder->getQuery();
        return $query->getResult();
    }

    private function create_roles() {
        $roles = $this->get_roles();

        if (empty($roles)) {
            foreach ($this->roles as $item) {
                $role = $this->build_role($item);
                $this->entity_manager->persist($role);
            }
        } else {
            foreach ($roles as $item) {
                if (in_array($item->get_name(), $this->roles)) continue;

                $role = $this->build_role($item->get_name());
                $this->entity_manager->persist($role);
            }
        }

        $this->entity_manager->flush();
    }

    private function build_role($role_name) {
        $role = new UserRole();
        $role->set_name($role_name);

        return $role;
    }
}

?>