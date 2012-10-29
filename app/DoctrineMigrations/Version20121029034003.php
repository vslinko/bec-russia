<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121029034003 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->createSequence('pages_id_seq');
        $pages = $schema->createTable('pages');
        $pages->addColumn('id', 'integer', array('autoincrement' => true));
        $pages->addColumn('uri', 'string', array('notnull' => false));
        $pages->addColumn('secret_key', 'string', array('notnull' => false));
        $pages->addColumn('title', 'string');
        $pages->addColumn('content', 'text');
        $pages->setPrimaryKey(array('id'));
    }

    public function down(Schema $schema)
    {
        $schema->dropSequence('pages_id_seq');
        $schema->dropTable('pages');
    }
}
