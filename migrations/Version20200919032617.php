<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200919032617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE agenda_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contato_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE local_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE agenda (id INT NOT NULL, local_id INT DEFAULT NULL, cargo VARCHAR(60) NOT NULL, nome VARCHAR(60) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2CEDC8775D5A2101 ON agenda (local_id)');
        $this->addSql('CREATE TABLE contato (id INT NOT NULL, agenda_id INT DEFAULT NULL, ramal BIGINT DEFAULT NULL, email VARCHAR(60) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C384AB42EA67784A ON contato (agenda_id)');
        $this->addSql('CREATE TABLE local (id INT NOT NULL, campus VARCHAR(70) NOT NULL, bloco VARCHAR(2) NOT NULL, sala INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE agenda ADD CONSTRAINT FK_2CEDC8775D5A2101 FOREIGN KEY (local_id) REFERENCES local (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contato ADD CONSTRAINT FK_C384AB42EA67784A FOREIGN KEY (agenda_id) REFERENCES agenda (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE contato DROP CONSTRAINT FK_C384AB42EA67784A');
        $this->addSql('ALTER TABLE agenda DROP CONSTRAINT FK_2CEDC8775D5A2101');
        $this->addSql('DROP SEQUENCE agenda_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contato_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE local_id_seq CASCADE');
        $this->addSql('DROP TABLE agenda');
        $this->addSql('DROP TABLE contato');
        $this->addSql('DROP TABLE local');
    }
}
