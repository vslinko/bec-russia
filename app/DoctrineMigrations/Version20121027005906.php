<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121027005906 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->dropTable('education_courses_towns');

        $educationCoursesTowns = $schema->createTable('education_courses_schools');
        $educationCoursesTowns->addColumn('education_course_id', 'integer');
        $educationCoursesTowns->addColumn('school_id', 'integer');
        $educationCoursesTowns->setPrimaryKey(array('education_course_id', 'school_id'));
        $educationCoursesTowns->addForeignKeyConstraint($schema->getTable('education_courses'), array('education_course_id'), array('id'));
        $educationCoursesTowns->addForeignKeyConstraint($schema->getTable('schools'), array('school_id'), array('id'));

        $schema->getTable('education_courses')->addColumn('image_id', 'integer');
    }

    public function down(Schema $schema)
    {
        $schema->getTable('education_courses')->dropColumn('image_id');

        $schema->dropTable('education_courses_schools');

        $educationCoursesTowns = $schema->createTable('education_courses_towns');
        $educationCoursesTowns->addColumn('education_course_id', 'integer');
        $educationCoursesTowns->addColumn('town_id', 'integer');
        $educationCoursesTowns->setPrimaryKey(array('education_course_id', 'town_id'));
        $educationCoursesTowns->addForeignKeyConstraint($schema->getTable('education_courses'), array('education_course_id'), array('id'));
        $educationCoursesTowns->addForeignKeyConstraint($schema->getTable('towns'), array('town_id'), array('id'));
    }
}
