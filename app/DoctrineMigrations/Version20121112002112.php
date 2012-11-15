<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121112002112 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->getTable('test_results')->addColumn('type', 'string', array('length' => 32));
    }

    public function down(Schema $schema)
    {
        $schema->getTable('test_results')->dropColumn('type');
    }
}
