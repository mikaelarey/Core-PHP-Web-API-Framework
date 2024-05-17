<?php

namespace Repository\Setup;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;

use Repository\Seeds\UserRoleSeed;
use Repository\Seeds\MessageSeed;
use Repository\Seeds\StatusSeed;
use Repository\Seeds\UserAccountSeed;
use Config\Connection;

class OrmSetup extends Connection {
    public function __construct() {
        parent::__construct();

        // Entities directory
        $entitiesPath = [ dirname(__DIR__) . "/Models" ];

        // Doctrine ORM configuration
        $config = Setup::createAnnotationMetadataConfiguration($entitiesPath, $this->isDevMode, null, null, false);
        $this->entityManager = EntityManager::create($this->conn, $config);
        $this->queryBuilder = $this->entityManager->createQueryBuilder();

        // Create SchemaTool
        $this->schemaTool = new SchemaTool($this->entityManager);
        // Get metadata for all entities
        $this->metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
    }
    
    public function create_schema() {
        // Create SchemaTool
        $schemaTool = new SchemaTool($this->entityManager);
        // Get metadata for all entities
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        // Create or update the database schema
        $schemaTool->updateSchema($metadata, true);
    }

    public function seed_data() {
        $user_role    = new UserRoleSeed($this->entityManager);
        // $message      = new MessageSeed($this->entityManager);
        // $status       = new StatusSeed($this->entityManager);
        $user_account = new UserAccountSeed($this->entityManager); 

        $this->create_schema();
        
        $user_role->seed_data();
        // $message->seed_data();
        // $status->seed_data();
        $user_account->seed_data();
    }
}

?>