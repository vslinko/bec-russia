<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121025021342 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schools = $schema->getTable('schools');
        $schools->addColumn('image_id', 'integer');
        $schools->addColumn('about', 'text');
        $schools->addColumn('discounts', 'text');

        $schema->getTable('teachers')->addColumn('image_id', 'integer');
    }

    public function down(Schema $schema)
    {
        $schema->getTable('teachers')->dropColumn('image_id');

        $schools = $schema->getTable('schools');
        $schools->dropColumn('discounts');
        $schools->dropColumn('about');
        $schools->dropColumn('image_id');
    }
}
