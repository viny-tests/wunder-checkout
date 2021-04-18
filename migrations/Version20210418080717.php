<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210418080717 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_D4E6F819395C3F3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__address AS SELECT id, customer_id, street, house_number, zip_code, city FROM address');
        $this->addSql('DROP TABLE address');
        $this->addSql('CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, customer_id VARCHAR(40) DEFAULT NULL, street VARCHAR(100) NOT NULL COLLATE BINARY, house_number VARCHAR(10) NOT NULL COLLATE BINARY, zip_code VARCHAR(5) NOT NULL COLLATE BINARY, city VARCHAR(100) NOT NULL COLLATE BINARY, CONSTRAINT FK_D4E6F819395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO address (id, customer_id, street, house_number, zip_code, city) SELECT id, customer_id, street, house_number, zip_code, city FROM __temp__address');
        $this->addSql('DROP TABLE __temp__address');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D4E6F819395C3F3 ON address (customer_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer AS SELECT id, first_name, last_name, telephone FROM customer');
        $this->addSql('DROP TABLE customer');
        $this->addSql('CREATE TABLE customer (id VARCHAR(40) NOT NULL, first_name VARCHAR(100) NOT NULL COLLATE BINARY, last_name VARCHAR(155) NOT NULL COLLATE BINARY, telephone VARCHAR(20) NOT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO customer (id, first_name, last_name, telephone) SELECT id, first_name, last_name, telephone FROM __temp__customer');
        $this->addSql('DROP TABLE __temp__customer');
        $this->addSql('DROP INDEX UNIQ_6D28840D9395C3F3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__payment AS SELECT id, customer_id, payment_data_id, iban, owner FROM payment');
        $this->addSql('DROP TABLE payment');
        $this->addSql('CREATE TABLE payment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, customer_id VARCHAR(40) DEFAULT NULL, payment_data_id VARCHAR(100) NOT NULL COLLATE BINARY, iban VARCHAR(100) NOT NULL COLLATE BINARY, owner VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_6D28840D9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO payment (id, customer_id, payment_data_id, iban, owner) SELECT id, customer_id, payment_data_id, iban, owner FROM __temp__payment');
        $this->addSql('DROP TABLE __temp__payment');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D28840D9395C3F3 ON payment (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_D4E6F819395C3F3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__address AS SELECT id, customer_id, street, house_number, zip_code, city FROM address');
        $this->addSql('DROP TABLE address');
        $this->addSql('CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, street VARCHAR(100) NOT NULL, house_number VARCHAR(10) NOT NULL, zip_code VARCHAR(5) NOT NULL, city VARCHAR(100) NOT NULL, customer_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO address (id, customer_id, street, house_number, zip_code, city) SELECT id, customer_id, street, house_number, zip_code, city FROM __temp__address');
        $this->addSql('DROP TABLE __temp__address');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D4E6F819395C3F3 ON address (customer_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer AS SELECT id, first_name, last_name, telephone FROM customer');
        $this->addSql('DROP TABLE customer');
        $this->addSql('CREATE TABLE customer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(155) NOT NULL, telephone VARCHAR(20) NOT NULL, uuid VARCHAR(40) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO customer (id, first_name, last_name, telephone) SELECT id, first_name, last_name, telephone FROM __temp__customer');
        $this->addSql('DROP TABLE __temp__customer');
        $this->addSql('DROP INDEX UNIQ_6D28840D9395C3F3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__payment AS SELECT id, customer_id, payment_data_id, iban, owner FROM payment');
        $this->addSql('DROP TABLE payment');
        $this->addSql('CREATE TABLE payment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, payment_data_id VARCHAR(100) NOT NULL, iban VARCHAR(100) NOT NULL, owner VARCHAR(255) NOT NULL, customer_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO payment (id, customer_id, payment_data_id, iban, owner) SELECT id, customer_id, payment_data_id, iban, owner FROM __temp__payment');
        $this->addSql('DROP TABLE __temp__payment');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D28840D9395C3F3 ON payment (customer_id)');
    }
}
