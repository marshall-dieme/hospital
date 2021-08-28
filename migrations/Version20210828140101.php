<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210828140101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, capacite INT NOT NULL, prix INT NOT NULL, occupation INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, secretaire_id INT NOT NULL, medecin_traitant_id INT NOT NULL, date DATE NOT NULL, etat TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_964685A66B899279 (patient_id), INDEX IDX_964685A6A90F02B2 (secretaire_id), INDEX IDX_964685A6B572964A (medecin_traitant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diagnostic (id INT AUTO_INCREMENT NOT NULL, type_diagnostic_id INT NOT NULL, chambre_id INT DEFAULT NULL, date_admission DATE NOT NULL, motif_admission LONGTEXT DEFAULT NULL, date_sortie DATE DEFAULT NULL, date_deces DATE DEFAULT NULL, motif_sortie LONGTEXT DEFAULT NULL, motif_deces LONGTEXT DEFAULT NULL, prescriptions JSON DEFAULT NULL, INDEX IDX_FA7C888952A17DA4 (type_diagnostic_id), INDEX IDX_FA7C88899B177F54 (chambre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, diagnostic_id INT NOT NULL, date DATE NOT NULL, montant INT NOT NULL, UNIQUE INDEX UNIQ_FE866410224CCA91 (diagnostic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, sexe VARCHAR(2) NOT NULL, assurance VARCHAR(255) NOT NULL, code_assurance VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, nom_parent_aprevenir VARCHAR(255) NOT NULL, tel_parent_aprevenir VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nom_service VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, service_id INT NOT NULL, nom_specialite VARCHAR(255) NOT NULL, INDEX IDX_E7D6FCC1ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_diagnostic (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, profil_id INT DEFAULT NULL, specialite_medecin_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, date_naissance DATE NOT NULL, sexe VARCHAR(2) NOT NULL, adresse LONGTEXT NOT NULL, situation_familiale VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D649275ED078 (profil_id), INDEX IDX_8D93D649E3E76190 (specialite_medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6A90F02B2 FOREIGN KEY (secretaire_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6B572964A FOREIGN KEY (medecin_traitant_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE diagnostic ADD CONSTRAINT FK_FA7C888952A17DA4 FOREIGN KEY (type_diagnostic_id) REFERENCES type_diagnostic (id)');
        $this->addSql('ALTER TABLE diagnostic ADD CONSTRAINT FK_FA7C88899B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410224CCA91 FOREIGN KEY (diagnostic_id) REFERENCES diagnostic (id)');
        $this->addSql('ALTER TABLE specialite ADD CONSTRAINT FK_E7D6FCC1ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649E3E76190 FOREIGN KEY (specialite_medecin_id) REFERENCES specialite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diagnostic DROP FOREIGN KEY FK_FA7C88899B177F54');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410224CCA91');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A66B899279');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649275ED078');
        $this->addSql('ALTER TABLE specialite DROP FOREIGN KEY FK_E7D6FCC1ED5CA9E6');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649E3E76190');
        $this->addSql('ALTER TABLE diagnostic DROP FOREIGN KEY FK_FA7C888952A17DA4');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6A90F02B2');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6B572964A');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE diagnostic');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE type_diagnostic');
        $this->addSql('DROP TABLE `user`');
    }
}
