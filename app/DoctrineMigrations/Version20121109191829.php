<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121109191829 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->getTable('schools')->addColumn('schedule', 'array');
    }

    public function down(Schema $schema)
    {
        $schema->getTable('schools')->dropColumn('schedule');
    }
}
