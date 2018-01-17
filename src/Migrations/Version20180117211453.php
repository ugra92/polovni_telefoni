<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180117211453 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_attribute_value (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, attribute_value_id INT DEFAULT NULL, attribute_id INT DEFAULT NULL, INDEX IDX_CCC4BE1F4584665A (product_id), INDEX IDX_CCC4BE1F65A22152 (attribute_value_id), INDEX IDX_CCC4BE1FB6E62EFA (attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_attribute_value ADD CONSTRAINT FK_CCC4BE1F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_attribute_value ADD CONSTRAINT FK_CCC4BE1F65A22152 FOREIGN KEY (attribute_value_id) REFERENCES attribute_value (id)');
        $this->addSql('ALTER TABLE product_attribute_value ADD CONSTRAINT FK_CCC4BE1FB6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE product_attribute_value');
    }
}
