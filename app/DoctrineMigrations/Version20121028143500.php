<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121028143500 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->createSequence('online_requests_id_seq');
        $onlineRequests = $schema->createTable('online_requests');
        $onlineRequests->addColumn('id', 'integer', array('autoincrement' => true));
        $onlineRequests->addColumn('name', 'string');
        $onlineRequests->addColumn('school_id', 'integer');
        $onlineRequests->addColumn('age', 'string', array('length' => 8));
        $onlineRequests->addColumn('education_course_id', 'integer');
        $onlineRequests->addColumn('language_level', 'string');
        $onlineRequests->addColumn('note', 'text');
        $onlineRequests->addColumn('email', 'string');
        $onlineRequests->addColumn('phone', 'string');
        $onlineRequests->addColumn('created_at', 'datetime');
        $onlineRequests->setPrimaryKey(array('id'));
        $onlineRequests->addForeignKeyConstraint($schema->getTable('schools'), array('school_id'), array('id'));
        $onlineRequests->addForeignKeyConstraint($schema->getTable('education_courses'), array('education_course_id'), array('id'));
    }

    public function down(Schema $schema)
    {
        $schema->dropSequence('online_requests_id_seq');

        $schema->dropTable('online_requests');
    }
}
