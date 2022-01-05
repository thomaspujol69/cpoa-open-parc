<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220105163545 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE arbitrator_game (arbitrator_id INTEGER NOT NULL, game_id INTEGER NOT NULL, PRIMARY KEY(arbitrator_id, game_id))');
        $this->addSql('CREATE INDEX IDX_A03E8B9D8C36C26A ON arbitrator_game (arbitrator_id)');
        $this->addSql('CREATE INDEX IDX_A03E8B9DE48FD905 ON arbitrator_game (game_id)');
        $this->addSql('CREATE TABLE ball_boy_game (ball_boy_id INTEGER NOT NULL, game_id INTEGER NOT NULL, PRIMARY KEY(ball_boy_id, game_id))');
        $this->addSql('CREATE INDEX IDX_95E3161F64FD12B8 ON ball_boy_game (ball_boy_id)');
        $this->addSql('CREATE INDEX IDX_95E3161FE48FD905 ON ball_boy_game (game_id)');
        $this->addSql('CREATE TABLE game (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chair_arbitrator_id INTEGER DEFAULT NULL, court_id INTEGER DEFAULT NULL, is_final BOOLEAN NOT NULL, date DATE NOT NULL, hour VARCHAR(255) NOT NULL, score VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_232B318CAE363C0C ON game (chair_arbitrator_id)');
        $this->addSql('CREATE INDEX IDX_232B318CE3184009 ON game (court_id)');
        $this->addSql('CREATE TABLE player_game (player_id INTEGER NOT NULL, game_id INTEGER NOT NULL, PRIMARY KEY(player_id, game_id))');
        $this->addSql('CREATE INDEX IDX_813161BF99E6F5DF ON player_game (player_id)');
        $this->addSql('CREATE INDEX IDX_813161BFE48FD905 ON player_game (game_id)');
        $this->addSql('CREATE TABLE promo_code (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, promo_percentage INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE ticket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, ticket_type_id INTEGER DEFAULT NULL, promo_code_id INTEGER DEFAULT NULL, date DATE NOT NULL)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3A76ED395 ON ticket (user_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3C980D5C1 ON ticket (ticket_type_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA32FAE4625 ON ticket (promo_code_id)');
        $this->addSql('CREATE TABLE ticket_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, promo_code_id INTEGER DEFAULT NULL, label VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE0542112FAE4625 ON ticket_type (promo_code_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__booking AS SELECT id, date_booking, hour_booking FROM booking');
        $this->addSql('DROP TABLE booking');
        $this->addSql('CREATE TABLE booking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, player_id INTEGER DEFAULT NULL, court_id INTEGER DEFAULT NULL, date_booking DATE NOT NULL, hour_booking VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_E00CEDDE99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E00CEDDEE3184009 FOREIGN KEY (court_id) REFERENCES court (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO booking (id, date_booking, hour_booking) SELECT id, date_booking, hour_booking FROM __temp__booking');
        $this->addSql('DROP TABLE __temp__booking');
        $this->addSql('CREATE INDEX IDX_E00CEDDE99E6F5DF ON booking (player_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDEE3184009 ON booking (court_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__player AS SELECT id, nationality, first_name, last_name FROM player');
        $this->addSql('DROP TABLE player');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, team_id INTEGER DEFAULT NULL, nationality VARCHAR(255) NOT NULL COLLATE BINARY, first_name VARCHAR(255) NOT NULL COLLATE BINARY, last_name VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_98197A65296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO player (id, nationality, first_name, last_name) SELECT id, nationality, first_name, last_name FROM __temp__player');
        $this->addSql('DROP TABLE __temp__player');
        $this->addSql('CREATE INDEX IDX_98197A65296CD8AE ON player (team_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE arbitrator_game');
        $this->addSql('DROP TABLE ball_boy_game');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE player_game');
        $this->addSql('DROP TABLE promo_code');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE ticket_type');
        $this->addSql('DROP INDEX IDX_E00CEDDE99E6F5DF');
        $this->addSql('DROP INDEX IDX_E00CEDDEE3184009');
        $this->addSql('CREATE TEMPORARY TABLE __temp__booking AS SELECT id, date_booking, hour_booking FROM booking');
        $this->addSql('DROP TABLE booking');
        $this->addSql('CREATE TABLE booking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date_booking DATE NOT NULL, hour_booking VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO booking (id, date_booking, hour_booking) SELECT id, date_booking, hour_booking FROM __temp__booking');
        $this->addSql('DROP TABLE __temp__booking');
        $this->addSql('DROP INDEX IDX_98197A65296CD8AE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__player AS SELECT id, nationality, first_name, last_name FROM player');
        $this->addSql('DROP TABLE player');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nationality VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO player (id, nationality, first_name, last_name) SELECT id, nationality, first_name, last_name FROM __temp__player');
        $this->addSql('DROP TABLE __temp__player');
    }
}
