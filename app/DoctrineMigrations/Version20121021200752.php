<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121021200752 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->createSequence('towns_id_seq');
        $towns = $schema->createTable('towns');
        $towns->addColumn('id', 'integer', array('autoincrement' => true));
        $towns->addColumn('slug', 'string', array('length' => 64));
        $towns->addColumn('name', 'string', array('length' => 64));
        $towns->setPrimaryKey(array('id'));

        $schema->createSequence('education_courses_id_seq');
        $educationCourses = $schema->createTable('education_courses');
        $educationCourses->addColumn('id', 'integer', array('autoincrement' => true));
        $educationCourses->addColumn('slug', 'string', array('length' => 140));
        $educationCourses->addColumn('title', 'string', array('length' => 140));
        $educationCourses->addColumn('annotation', 'text');
        $educationCourses->addColumn('description', 'text');
        $educationCourses->addColumn('website', 'string', array('notnull' => false));
        $educationCourses->setPrimaryKey(array('id'));

        $educationCoursesTowns = $schema->createTable('education_courses_towns');
        $educationCoursesTowns->addColumn('education_course_id', 'integer');
        $educationCoursesTowns->addColumn('town_id', 'integer');
        $educationCoursesTowns->setPrimaryKey(array('education_course_id', 'town_id'));
        $educationCoursesTowns->addForeignKeyConstraint($educationCourses, array('education_course_id'), array('id'));
        $educationCoursesTowns->addForeignKeyConstraint($towns, array('town_id'), array('id'));

        $schema->createSequence('schools_id_seq');
        $schools = $schema->createTable('schools');
        $schools->addColumn('id', 'integer', array('autoincrement' => true));
        $schools->addColumn('town_id', 'integer');
        $schools->addColumn('slug', 'string', array('length' => 140));
        $schools->addColumn('title', 'string', array('length' => 140));
        $schools->addColumn('address', 'string');
        $schools->setPrimaryKey(array('id'));
        $schools->addForeignKeyConstraint($towns, array('town_id'), array('id'));

        $phones = $schema->createTable('phones');
        $phones->addColumn('number', 'string', array('length' => 32));
        $phones->addColumn('visible_for_town', 'boolean');
        $phones->addColumn('school_id', 'integer', array('notnull' => false));
        $phones->setPrimaryKey(array('number'));
        $phones->addForeignKeyConstraint($schools, array('school_id'), array('id'));

        $schema->createSequence('teachers_id_seq');
        $teachers = $schema->createTable('teachers');
        $teachers->addColumn('id', 'integer', array('autoincrement' => true));
        $teachers->addColumn('school_id', 'integer');
        $teachers->addColumn('slug', 'string', array('length' => 255));
        $teachers->addColumn('name', 'string', array('length' => 255));
        $teachers->addColumn('description', 'text');
        $teachers->setPrimaryKey(array('id'));
        $teachers->addForeignKeyConstraint($schools, array('school_id'), array('id'));

        $schema->createSequence('news_id_seq');
        $news = $schema->createTable('news');
        $news->addColumn('id', 'integer', array('autoincrement' => true));
        $news->addColumn('school_id', 'integer', array('notnull' => false));
        $news->addColumn('slug', 'string', array('length' => 140));
        $news->addColumn('title', 'string', array('length' => 140));
        $news->addColumn('annotation', 'text');
        $news->addColumn('description', 'text');
        $news->setPrimaryKey(array('id'));
        $news->addForeignKeyConstraint($schools, array('school_id'), array('id'));

        $schema->createSequence('vacancies_id_seq');
        $vacancies = $schema->createTable('vacancies');
        $vacancies->addColumn('id', 'integer', array('autoincrement' => true));
        $vacancies->addColumn('school_id', 'integer', array('notnull' => false));
        $vacancies->addColumn('slug', 'string', array('length' => 140));
        $vacancies->addColumn('title', 'string', array('length' => 140));
        $vacancies->addColumn('annotation', 'text');
        $vacancies->addColumn('description', 'text');
        $vacancies->setPrimaryKey(array('id'));
        $vacancies->addForeignKeyConstraint($schools, array('school_id'), array('id'));
    }

    public function down(Schema $schema)
    {
        $schema->dropSequence('vacancies_id_seq');
        $schema->dropSequence('news_id_seq');
        $schema->dropSequence('teachers_id_seq');
        $schema->dropSequence('schools_id_seq');
        $schema->dropSequence('education_courses_id_seq');
        $schema->dropSequence('towns_id_seq');

        $schema->dropTable('vacancies');
        $schema->dropTable('news');
        $schema->dropTable('teachers');
        $schema->dropTable('phones');
        $schema->dropTable('schools');
        $schema->dropTable('education_courses_towns');
        $schema->dropTable('education_courses');
        $schema->dropTable('towns');
    }
}
