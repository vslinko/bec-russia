<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121027021914 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->createSequence('polls_id_seq');
        $polls = $schema->createTable('polls');
        $polls->addColumn('id', 'integer');
        $polls->addColumn('question', 'string', array('length' => 140));
        $polls->addColumn('created_at', 'datetime');
        $polls->setPrimaryKey(array('id'));

        $schema->createSequence('poll_answers_id_seq');
        $pollAnswers = $schema->createTable('poll_answers');
        $pollAnswers->addColumn('id', 'integer');
        $pollAnswers->addColumn('answer', 'string', array('length' => 140));
        $pollAnswers->addColumn('count', 'integer');
        $pollAnswers->addColumn('poll_id', 'integer', array('notnull' => false));
        $pollAnswers->setPrimaryKey(array('id'));
        $pollAnswers->addForeignKeyConstraint($polls, array('poll_id'), array('id'));
    }

    public function down(Schema $schema)
    {
        $schema->dropSequence('poll_answers_id_seq');
        $schema->dropSequence('polls_id_seq');

        $schema->dropTable('poll_answers');
        $schema->dropTable('polls');
    }
}
