<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121109212529 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->createSequence('schools_comments_id_seq');
        $schoolComments = $schema->createTable('schools_comments');
        $schoolComments->addColumn('id', 'integer', array('autoincrement' => true));
        $schoolComments->addColumn('author_name', 'string', array('length' => 140));
        $schoolComments->addColumn('author_email', 'string');
        $schoolComments->addColumn('text', 'text');
        $schoolComments->addColumn('moderated', 'boolean');
        $schoolComments->addColumn('school_id', 'integer');
        $schoolComments->setPrimaryKey(array('id'));
        $schoolComments->addForeignKeyConstraint($schema->getTable('schools'), array('school_id'), array('id'));
    }

    public function down(Schema $schema)
    {
        $schema->dropSequence('schools_comments_id_seq');
        $schema->dropTable('schools_comments');
    }
}
