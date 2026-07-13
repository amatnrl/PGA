<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Unifies Insight/Recipe/Article/Activity into one simple shape:
 * title, content, featured_image, updated_by, published_at, status.
 * Drops the now-unused category/tag system entirely.
 */
class SimplifyContentModules extends Migration
{
    public function up()
    {
        $this->forge->dropForeignKey('insights', 'insights_category_id_foreign');
        $this->forge->dropForeignKey('recipes', 'recipes_category_id_foreign');
        $this->forge->dropForeignKey('articles', 'articles_category_id_foreign');
        $this->forge->dropForeignKey('taggables', 'taggables_tag_id_foreign');
        $this->forge->dropForeignKey('categories', 'categories_parent_id_foreign');

        $this->db->disableForeignKeyChecks();

        $this->forge->dropColumn('insights', [
            'category_id', 'excerpt', 'author', 'is_popular', 'views_count',
            'meta_title', 'meta_description', 'meta_keywords',
        ]);
        $this->forge->addColumn('insights', [
            'updated_by' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'default' => 'Admin', 'after' => 'featured_image'],
        ]);

        $this->forge->dropColumn('recipes', [
            'category_id', 'excerpt', 'ingredients', 'steps', 'video_url',
            'meta_title', 'meta_description', 'meta_keywords',
        ]);
        $this->forge->addColumn('recipes', [
            'updated_by' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'default' => 'Admin', 'after' => 'featured_image'],
        ]);

        $this->forge->dropColumn('articles', [
            'category_id', 'excerpt', 'type',
            'meta_title', 'meta_description', 'meta_keywords',
        ]);
        $this->forge->addColumn('articles', [
            'updated_by' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'default' => 'Admin', 'after' => 'featured_image'],
        ]);

        $this->forge->dropColumn('activities', [
            'type', 'excerpt', 'location', 'event_date', 'gallery',
            'meta_title', 'meta_description', 'meta_keywords',
        ]);
        $this->forge->addColumn('activities', [
            'updated_by'   => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'default' => 'Admin', 'after' => 'featured_image'],
            'published_at' => ['type' => 'DATE', 'null' => true, 'after' => 'updated_by'],
        ]);

        $this->forge->dropTable('taggables', true);
        $this->forge->dropTable('tags', true);
        $this->forge->dropTable('categories', true);

        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        // Irreversible simplification; recreate columns with defaults if ever needed.
    }
}
