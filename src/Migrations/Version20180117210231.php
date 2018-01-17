<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180117210231 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE attribute ADD attribute_set_id INT DEFAULT NULL, ADD featured TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE attribute ADD CONSTRAINT FK_FA7AEFFB321A2342 FOREIGN KEY (attribute_set_id) REFERENCES attribute_set (id)');
        $this->addSql('CREATE INDEX IDX_FA7AEFFB321A2342 ON attribute (attribute_set_id)');
        $this->addSql('ALTER TABLE attribute_value ADD attribute_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attribute_value ADD CONSTRAINT FK_FE4FBB82B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id)');
        $this->addSql('CREATE INDEX IDX_FE4FBB82B6E62EFA ON attribute_value (attribute_id)');
        $this->addSql('ALTER TABLE image ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F4584665A ON image (product_id)');
        $this->addSql('ALTER TABLE product ADD attribute_set_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD321A2342 FOREIGN KEY (attribute_set_id) REFERENCES attribute_set (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD321A2342 ON product (attribute_set_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE attribute DROP FOREIGN KEY FK_FA7AEFFB321A2342');
        $this->addSql('DROP INDEX IDX_FA7AEFFB321A2342 ON attribute');
        $this->addSql('ALTER TABLE attribute DROP attribute_set_id, DROP featured');
        $this->addSql('ALTER TABLE attribute_value DROP FOREIGN KEY FK_FE4FBB82B6E62EFA');
        $this->addSql('DROP INDEX IDX_FE4FBB82B6E62EFA ON attribute_value');
        $this->addSql('ALTER TABLE attribute_value DROP attribute_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4584665A');
        $this->addSql('DROP INDEX IDX_C53D045F4584665A ON image');
        $this->addSql('ALTER TABLE image DROP product_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD321A2342');
        $this->addSql('DROP INDEX IDX_D34A04AD321A2342 ON product');
        $this->addSql('ALTER TABLE product DROP attribute_set_id');
    }
}
