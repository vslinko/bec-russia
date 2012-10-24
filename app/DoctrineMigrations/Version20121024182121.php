<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121024182121 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->getTable('news')->addColumn('created_at', 'datetime');
    }

    public function down(Schema $schema)
    {
        $schema->getTable('news')->dropColumn('created_at');
    }
}
