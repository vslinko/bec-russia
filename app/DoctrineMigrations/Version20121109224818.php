<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121109224818 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->createSequence('book_categories_id_seq');
        $bookCategories = $schema->createTable('book_categories');
        $bookCategories->addColumn('id', 'integer', array('autoincrement' => true));
        $bookCategories->addColumn('slug', 'string', array('length' => 140));
        $bookCategories->addColumn('name', 'string', array('length' => 140));
        $bookCategories->addColumn('description', 'text', array('length' => 140));
        $bookCategories->setPrimaryKey(array('id'));

        $schema->createSequence('books_id_seq');
        $books = $schema->createTable('books');
        $books->addColumn('id', 'integer', array('autoincrement' => true));
        $books->addColumn('category_id', 'integer', array('notnull' => false));
        $books->addColumn('file_id', 'integer', array('notnull' => false));
        $books->addColumn('slug', 'string', array('length' => 140));
        $books->addColumn('name', 'string', array('length' => 140));
        $books->addColumn('description', 'text', array('length' => 140));
        $books->setPrimaryKey(array('id'));
        $books->addUniqueIndex(array('file_id'));
        $books->addForeignKeyConstraint($bookCategories, array('category_id'), array('id'));
        $books->addForeignKeyConstraint($schema->getTable('media'), array('file_id'), array('id'));
    }

    public function down(Schema $schema)
    {
        $schema->dropSequence('book_categories_id_seq');
        $schema->dropSequence('books_id_seq');
        $schema->dropTable('book_categories');
        $schema->dropTable('books');
    }
}
