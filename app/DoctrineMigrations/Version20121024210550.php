<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121024210550 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->createSequence('media_id_seq');
        $media = $schema->createTable('media');
        $media->addColumn('id', 'integer', array('autoincrement' => true));
        $media->addColumn('name', 'string');
        $media->addColumn('description', 'text', array('notnull' => false));
        $media->addColumn('enabled', 'boolean');
        $media->addColumn('provider_name', 'string', array('default' => 'image'));
        $media->addColumn('provider_status', 'integer');
        $media->addColumn('provider_reference', 'string');
        $media->addColumn('provider_metadata', 'array', array('notnull' => false));
        $media->addColumn('width', 'integer', array('notnull' => false));
        $media->addColumn('height', 'integer', array('notnull' => false));
        $media->addColumn('length', 'decimal', array('notnull' => false));
        $media->addColumn('content_type', 'string', array('notnull' => false, 'length' => 64));
        $media->addColumn('content_size', 'integer', array('notnull' => false));
        $media->addColumn('copyright', 'string', array('notnull' => false));
        $media->addColumn('author_name', 'string', array('notnull' => false));
        $media->addColumn('context', 'string', array('notnull' => false, 'length' => 16));
        $media->addColumn('cdn_is_flushable', 'boolean', array('notnull' => false));
        $media->addColumn('cdn_flush_at', 'datetime', array('notnull' => false));
        $media->addColumn('cdn_status', 'integer', array('notnull' => false));
        $media->addColumn('updated_at', 'datetime');
        $media->addColumn('created_at', 'datetime');
        $media->setPrimaryKey(array('id'));

        $schema->getTable('news')->addColumn('image_id', 'integer');
    }

    public function down(Schema $schema)
    {
        $schema->getTable('news')->dropColumn('image_id');

        $schema->dropSequence('media_id_seq');
        $schema->dropTable('media');
    }
}
