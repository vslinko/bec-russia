<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121028150500 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->getTable('education_course_types')->addColumn('age', 'string', array('length' => 8, 'notnull' => false));
    }

    public function down(Schema $schema)
    {
        $schema->getTable('education_course_types')->dropColumn('age');
    }
}
