<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121110001856 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->getTable('phones')->addColumn('global', 'boolean', array('default' => false));
    }

    public function down(Schema $schema)
    {
        $schema->getTable('phones')->dropColumn('global');
    }
}
