<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121027023218 extends AbstractMigration
{
    static private $tableNames = array('education_courses', 'education_course_types', 'news', 'schools', 'teachers');

    public function up(Schema $schema)
    {
        $media = $schema->getTable('media');

        foreach (self::$tableNames as $tableName) {
            $table = $schema->getTable($tableName);
            $table->addForeignKeyConstraint($media, array('image_id'), array('id'), array(), 'fk_image');
            $table->addUniqueIndex(array('image_id'), $tableName . '_uniq_image');
        }
    }

    public function down(Schema $schema)
    {
        foreach (self::$tableNames as $tableName) {
            $table = $schema->getTable($tableName);
            $table->removeForeignKey('fk_image');
            $table->dropIndex($tableName . '_uniq_image');
        }
    }
}
