<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121027164207 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->createSequence('galleries_id_seq');
        $galleries = $schema->createTable('galleries');
        $galleries->addColumn('id', 'integer', array('autoincrement' => true));
        $galleries->addColumn('name', 'string');
        $galleries->addColumn('context', 'string');
        $galleries->addColumn('default_format', 'string');
        $galleries->addColumn('enabled', 'boolean');
        $galleries->addColumn('updated_at', 'datetime');
        $galleries->addColumn('created_at', 'datetime');
        $galleries->setPrimaryKey(array('id'));

        $schema->createSequence('galleries_medias_id_seq');
        $galleries = $schema->createTable('galleries_medias');
        $galleries->addColumn('id', 'integer', array('autoincrement' => true));
        $galleries->addColumn('position', 'integer');
        $galleries->addColumn('enabled', 'boolean');
        $galleries->addColumn('updated_at', 'datetime');
        $galleries->addColumn('created_at', 'datetime');
        $galleries->setPrimaryKey(array('id'));
    }

    public function down(Schema $schema)
    {
        $schema->dropSequence('galleries_id_seq');
        $schema->dropSequence('galleries_medias_id_seq');

        $schema->dropTable('galleries');
        $schema->dropTable('galleries_medias');
    }
}
