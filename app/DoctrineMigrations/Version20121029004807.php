<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121029004807 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->createSequence('test_questions_id_seq');
        $testQuestions = $schema->createTable('test_questions');
        $testQuestions->addColumn('id', 'integer', array('autoincrement' => true));
        $testQuestions->addColumn('question', 'string');
        $testQuestions->setPrimaryKey(array('id'));

        $schema->createSequence('test_answers_id_seq');
        $testAnswers = $schema->createTable('test_answers');
        $testAnswers->addColumn('id', 'integer', array('autoincrement' => true));
        $testAnswers->addColumn('answer', 'string');
        $testAnswers->addColumn('points', 'integer');
        $testAnswers->addColumn('question_id', 'integer');
        $testAnswers->setPrimaryKey(array('id'));
        $testAnswers->addForeignKeyConstraint($testQuestions, array('question_id'), array('id'));

        $schema->createSequence('test_results_id_seq');
        $testResults = $schema->createTable('test_results');
        $testResults->addColumn('id', 'integer', array('autoincrement' => true));
        $testResults->addColumn('title', 'string');
        $testResults->addColumn('minimal_points', 'integer');
        $testResults->addColumn('result', 'text');
        $testResults->setPrimaryKey(array('id'));
    }

    public function down(Schema $schema)
    {
        $schema->dropSequence('test_questions_id_seq');
        $schema->dropSequence('test_answers_id_seq');
        $schema->dropSequence('test_results_id_seq');

        $schema->dropTable('test_questions');
        $schema->dropTable('test_answers');
        $schema->dropTable('test_results');
    }
}
