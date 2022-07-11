<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511154332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) DEFAULT NULL, created_at DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATE DEFAULT NULL, warenty DATE DEFAULT NULL, details VARCHAR(255) DEFAULT NULL, INDEX IDX_6B8170449395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, service_id VARCHAR(255) DEFAULT NULL, created_at DATE DEFAULT NULL, problem VARCHAR(255) DEFAULT NULL, service_status VARCHAR(255) DEFAULT NULL, type_of_pending VARCHAR(255) DEFAULT NULL, remarks VARCHAR(255) DEFAULT NULL, closing_at DATE DEFAULT NULL, fsr_id VARCHAR(255) DEFAULT NULL, invoice_id VARCHAR(255) DEFAULT NULL, amount NUMERIC(10, 3) DEFAULT NULL, invoice_status VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_user (service_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_43D062A5ED5CA9E6 (service_id), INDEX IDX_43D062A5A76ED395 (user_id), PRIMARY KEY(service_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_customer (service_id INT NOT NULL, customer_id INT NOT NULL, INDEX IDX_784FD534ED5CA9E6 (service_id), INDEX IDX_784FD5349395C3F3 (customer_id), PRIMARY KEY(service_id, customer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_sales (service_id INT NOT NULL, sales_id INT NOT NULL, INDEX IDX_C2F39DA3ED5CA9E6 (service_id), INDEX IDX_C2F39DA3A4522A07 (sales_id), PRIMARY KEY(service_id, sales_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT FK_6B8170449395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE service_user ADD CONSTRAINT FK_43D062A5ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_user ADD CONSTRAINT FK_43D062A5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_customer ADD CONSTRAINT FK_784FD534ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_customer ADD CONSTRAINT FK_784FD5349395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_sales ADD CONSTRAINT FK_C2F39DA3ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_sales ADD CONSTRAINT FK_C2F39DA3A4522A07 FOREIGN KEY (sales_id) REFERENCES sales (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sales DROP FOREIGN KEY FK_6B8170449395C3F3');
        $this->addSql('ALTER TABLE service_customer DROP FOREIGN KEY FK_784FD5349395C3F3');
        $this->addSql('ALTER TABLE service_sales DROP FOREIGN KEY FK_C2F39DA3A4522A07');
        $this->addSql('ALTER TABLE service_user DROP FOREIGN KEY FK_43D062A5ED5CA9E6');
        $this->addSql('ALTER TABLE service_customer DROP FOREIGN KEY FK_784FD534ED5CA9E6');
        $this->addSql('ALTER TABLE service_sales DROP FOREIGN KEY FK_C2F39DA3ED5CA9E6');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE sales');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_user');
        $this->addSql('DROP TABLE service_customer');
        $this->addSql('DROP TABLE service_sales');
    }
}
