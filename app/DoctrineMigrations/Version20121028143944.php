<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

use Doctrine\DBAL\Types\Type;

class Version20121028143944 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->getTable('education_course_types')->addColumn('description', 'text');
    }

    public function down(Schema $schema)
    {
        $schema->getTable('education_course_types')->dropColumn('description');
    }
}
