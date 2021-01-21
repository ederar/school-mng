<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210117194023 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE teacher_class_room (teacher_id INT NOT NULL, class_room_id INT NOT NULL, INDEX IDX_4CFDC47441807E1D (teacher_id), INDEX IDX_4CFDC4749162176F (class_room_id), PRIMARY KEY(teacher_id, class_room_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE teacher_class_room ADD CONSTRAINT FK_4CFDC47441807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teacher_class_room ADD CONSTRAINT FK_4CFDC4749162176F FOREIGN KEY (class_room_id) REFERENCES class_room (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE teacher_class_room');
    }
}
