<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121028155918 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $educationCourses = $schema->getTable('education_courses');
        $educationCourses->addColumn('reason', 'string');
        $educationCourses->addColumn('schedule', 'string');
        $educationCourses->addColumn('languageLevel', 'string');
    }

    public function down(Schema $schema)
    {
        $educationCourses = $schema->getTable('education_courses');
        $educationCourses->dropColumn('reason');
        $educationCourses->dropColumn('schedule');
        $educationCourses->dropColumn('languageLevel');
    }
}
