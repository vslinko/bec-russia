<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121026205409 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->createSequence('education_courses_types_id_seq');
        $educationCourseTypes = $schema->createTable('education_course_types');
        $educationCourseTypes->addColumn('id', 'integer', array('autoincrement' => true));
        $educationCourseTypes->addColumn('slug', 'string', array('length' => 64));
        $educationCourseTypes->addColumn('title', 'string', array('length' => 64));
        $educationCourseTypes->addColumn('note', 'string');
        $educationCourseTypes->addColumn('image_id', 'integer');
        $educationCourseTypes->setPrimaryKey(array('id'));

        $educationCourses = $schema->getTable('education_courses');
        $educationCourses->addColumn('type_id', 'integer');
        $educationCourses->addForeignKeyConstraint($educationCourseTypes, array('type_id'), array('id'));
    }

    public function down(Schema $schema)
    {
        $schema->dropSequence('education_courses_types_id_seq');
        $schema->getTable('education_courses')->dropColumn('type_id');
        $schema->dropTable('education_course_types');
    }
}
