<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220123125407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ball_boys_team (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('DROP INDEX IDX_A03E8B9DE48FD905');
        $this->addSql('DROP INDEX IDX_A03E8B9D8C36C26A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__arbitrator_game AS SELECT arbitrator_id, game_id FROM arbitrator_game');
        $this->addSql('DROP TABLE arbitrator_game');
        $this->addSql('CREATE TABLE arbitrator_game (arbitrator_id INTEGER NOT NULL, game_id INTEGER NOT NULL, PRIMARY KEY(arbitrator_id, game_id), CONSTRAINT FK_A03E8B9D8C36C26A FOREIGN KEY (arbitrator_id) REFERENCES arbitrator (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A03E8B9DE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO arbitrator_game (arbitrator_id, game_id) SELECT arbitrator_id, game_id FROM __temp__arbitrator_game');
        $this->addSql('DROP TABLE __temp__arbitrator_game');
        $this->addSql('CREATE INDEX IDX_A03E8B9DE48FD905 ON arbitrator_game (game_id)');
        $this->addSql('CREATE INDEX IDX_A03E8B9D8C36C26A ON arbitrator_game (arbitrator_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ball_boy AS SELECT id, name FROM ball_boy');
        $this->addSql('DROP TABLE ball_boy');
        $this->addSql('CREATE TABLE ball_boy (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ball_boys_team_id INTEGER DEFAULT NULL, name VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_EA58D4D98A371DB4 FOREIGN KEY (ball_boys_team_id) REFERENCES ball_boys_team (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ball_boy (id, name) SELECT id, name FROM __temp__ball_boy');
        $this->addSql('DROP TABLE __temp__ball_boy');
        $this->addSql('CREATE INDEX IDX_EA58D4D98A371DB4 ON ball_boy (ball_boys_team_id)');
        $this->addSql('DROP INDEX IDX_95E3161FE48FD905');
        $this->addSql('DROP INDEX IDX_95E3161F64FD12B8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ball_boy_game AS SELECT ball_boy_id, game_id FROM ball_boy_game');
        $this->addSql('DROP TABLE ball_boy_game');
        $this->addSql('CREATE TABLE ball_boy_game (ball_boy_id INTEGER NOT NULL, game_id INTEGER NOT NULL, PRIMARY KEY(ball_boy_id, game_id), CONSTRAINT FK_95E3161F64FD12B8 FOREIGN KEY (ball_boy_id) REFERENCES ball_boy (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_95E3161FE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ball_boy_game (ball_boy_id, game_id) SELECT ball_boy_id, game_id FROM __temp__ball_boy_game');
        $this->addSql('DROP TABLE __temp__ball_boy_game');
        $this->addSql('CREATE INDEX IDX_95E3161FE48FD905 ON ball_boy_game (game_id)');
        $this->addSql('CREATE INDEX IDX_95E3161F64FD12B8 ON ball_boy_game (ball_boy_id)');
        $this->addSql('DROP INDEX IDX_E00CEDDEE3184009');
        $this->addSql('DROP INDEX IDX_E00CEDDE99E6F5DF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__booking AS SELECT id, player_id, court_id, date_booking, hour_booking FROM booking');
        $this->addSql('DROP TABLE booking');
        $this->addSql('CREATE TABLE booking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, player_id INTEGER DEFAULT NULL, court_id INTEGER DEFAULT NULL, date_booking DATE NOT NULL, hour_booking VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_E00CEDDE99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E00CEDDEE3184009 FOREIGN KEY (court_id) REFERENCES court (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO booking (id, player_id, court_id, date_booking, hour_booking) SELECT id, player_id, court_id, date_booking, hour_booking FROM __temp__booking');
        $this->addSql('DROP TABLE __temp__booking');
        $this->addSql('CREATE INDEX IDX_E00CEDDEE3184009 ON booking (court_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE99E6F5DF ON booking (player_id)');
        $this->addSql('DROP INDEX IDX_232B318C9C24126');
        $this->addSql('DROP INDEX IDX_232B318CE3184009');
        $this->addSql('DROP INDEX IDX_232B318CAE363C0C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__game AS SELECT id, chair_arbitrator_id, court_id, day_id, is_final, date, hour, score, is_double FROM game');
        $this->addSql('DROP TABLE game');
        $this->addSql('CREATE TABLE game (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chair_arbitrator_id INTEGER DEFAULT NULL, court_id INTEGER DEFAULT NULL, day_id INTEGER NOT NULL, is_final BOOLEAN NOT NULL, date DATE NOT NULL, hour VARCHAR(255) NOT NULL COLLATE BINARY, score VARCHAR(255) DEFAULT NULL COLLATE BINARY, is_double BOOLEAN NOT NULL, CONSTRAINT FK_232B318CAE363C0C FOREIGN KEY (chair_arbitrator_id) REFERENCES arbitrator (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_232B318CE3184009 FOREIGN KEY (court_id) REFERENCES court (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_232B318C9C24126 FOREIGN KEY (day_id) REFERENCES day (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO game (id, chair_arbitrator_id, court_id, day_id, is_final, date, hour, score, is_double) SELECT id, chair_arbitrator_id, court_id, day_id, is_final, date, hour, score, is_double FROM __temp__game');
        $this->addSql('DROP TABLE __temp__game');
        $this->addSql('CREATE INDEX IDX_232B318C9C24126 ON game (day_id)');
        $this->addSql('CREATE INDEX IDX_232B318CE3184009 ON game (court_id)');
        $this->addSql('CREATE INDEX IDX_232B318CAE363C0C ON game (chair_arbitrator_id)');
        $this->addSql('DROP INDEX IDX_2FF5CA33296CD8AE');
        $this->addSql('DROP INDEX IDX_2FF5CA33E48FD905');
        $this->addSql('CREATE TEMPORARY TABLE __temp__game_team AS SELECT game_id, team_id FROM game_team');
        $this->addSql('DROP TABLE game_team');
        $this->addSql('CREATE TABLE game_team (game_id INTEGER NOT NULL, team_id INTEGER NOT NULL, PRIMARY KEY(game_id, team_id), CONSTRAINT FK_2FF5CA33E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2FF5CA33296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO game_team (game_id, team_id) SELECT game_id, team_id FROM __temp__game_team');
        $this->addSql('DROP TABLE __temp__game_team');
        $this->addSql('CREATE INDEX IDX_2FF5CA33296CD8AE ON game_team (team_id)');
        $this->addSql('CREATE INDEX IDX_2FF5CA33E48FD905 ON game_team (game_id)');
        $this->addSql('DROP INDEX IDX_98197A65296CD8AE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__player AS SELECT id, team_id, nationality, first_name, last_name FROM player');
        $this->addSql('DROP TABLE player');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, team_id INTEGER DEFAULT NULL, nationality VARCHAR(255) NOT NULL COLLATE BINARY, first_name VARCHAR(255) NOT NULL COLLATE BINARY, last_name VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_98197A65296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO player (id, team_id, nationality, first_name, last_name) SELECT id, team_id, nationality, first_name, last_name FROM __temp__player');
        $this->addSql('DROP TABLE __temp__player');
        $this->addSql('CREATE INDEX IDX_98197A65296CD8AE ON player (team_id)');
        $this->addSql('DROP INDEX IDX_813161BFE48FD905');
        $this->addSql('DROP INDEX IDX_813161BF99E6F5DF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__player_game AS SELECT player_id, game_id FROM player_game');
        $this->addSql('DROP TABLE player_game');
        $this->addSql('CREATE TABLE player_game (player_id INTEGER NOT NULL, game_id INTEGER NOT NULL, PRIMARY KEY(player_id, game_id), CONSTRAINT FK_813161BF99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_813161BFE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO player_game (player_id, game_id) SELECT player_id, game_id FROM __temp__player_game');
        $this->addSql('DROP TABLE __temp__player_game');
        $this->addSql('CREATE INDEX IDX_813161BFE48FD905 ON player_game (game_id)');
        $this->addSql('CREATE INDEX IDX_813161BF99E6F5DF ON player_game (player_id)');
        $this->addSql('DROP INDEX UNIQ_3D8C939E77153098');
        $this->addSql('DROP INDEX UNIQ_3D8C939EEA750E8');
        $this->addSql('DROP INDEX UNIQ_3D8C939EC980D5C1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__promo_code AS SELECT id, ticket_type_id, label, code FROM promo_code');
        $this->addSql('DROP TABLE promo_code');
        $this->addSql('CREATE TABLE promo_code (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ticket_type_id INTEGER DEFAULT NULL, label VARCHAR(255) NOT NULL COLLATE BINARY, code VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_3D8C939EC980D5C1 FOREIGN KEY (ticket_type_id) REFERENCES ticket_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO promo_code (id, ticket_type_id, label, code) SELECT id, ticket_type_id, label, code FROM __temp__promo_code');
        $this->addSql('DROP TABLE __temp__promo_code');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D8C939E77153098 ON promo_code (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D8C939EEA750E8 ON promo_code (label)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D8C939EC980D5C1 ON promo_code (ticket_type_id)');
        $this->addSql('DROP INDEX IDX_97A0ADA39C24126');
        $this->addSql('DROP INDEX IDX_97A0ADA32FAE4625');
        $this->addSql('DROP INDEX IDX_97A0ADA3C980D5C1');
        $this->addSql('DROP INDEX IDX_97A0ADA3A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticket AS SELECT id, user_id, ticket_type_id, promo_code_id, day_id, date FROM ticket');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('CREATE TABLE ticket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, ticket_type_id INTEGER DEFAULT NULL, promo_code_id INTEGER DEFAULT NULL, day_id INTEGER DEFAULT NULL, date DATE NOT NULL, CONSTRAINT FK_97A0ADA3A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_97A0ADA3C980D5C1 FOREIGN KEY (ticket_type_id) REFERENCES ticket_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_97A0ADA32FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_97A0ADA39C24126 FOREIGN KEY (day_id) REFERENCES day (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ticket (id, user_id, ticket_type_id, promo_code_id, day_id, date) SELECT id, user_id, ticket_type_id, promo_code_id, day_id, date FROM __temp__ticket');
        $this->addSql('DROP TABLE __temp__ticket');
        $this->addSql('CREATE INDEX IDX_97A0ADA39C24126 ON ticket (day_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA32FAE4625 ON ticket (promo_code_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3C980D5C1 ON ticket (ticket_type_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3A76ED395 ON ticket (user_id)');
        $this->addSql('DROP INDEX UNIQ_BE0542112FAE4625');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticket_type AS SELECT id, promo_code_id, label, price_percentage FROM ticket_type');
        $this->addSql('DROP TABLE ticket_type');
        $this->addSql('CREATE TABLE ticket_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, promo_code_id INTEGER DEFAULT NULL, label VARCHAR(255) NOT NULL COLLATE BINARY, price_percentage DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_BE0542112FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ticket_type (id, promo_code_id, label, price_percentage) SELECT id, promo_code_id, label, price_percentage FROM __temp__ticket_type');
        $this->addSql('DROP TABLE __temp__ticket_type');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE0542112FAE4625 ON ticket_type (promo_code_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ball_boys_team');
        $this->addSql('DROP INDEX IDX_A03E8B9D8C36C26A');
        $this->addSql('DROP INDEX IDX_A03E8B9DE48FD905');
        $this->addSql('CREATE TEMPORARY TABLE __temp__arbitrator_game AS SELECT arbitrator_id, game_id FROM arbitrator_game');
        $this->addSql('DROP TABLE arbitrator_game');
        $this->addSql('CREATE TABLE arbitrator_game (arbitrator_id INTEGER NOT NULL, game_id INTEGER NOT NULL, PRIMARY KEY(arbitrator_id, game_id))');
        $this->addSql('INSERT INTO arbitrator_game (arbitrator_id, game_id) SELECT arbitrator_id, game_id FROM __temp__arbitrator_game');
        $this->addSql('DROP TABLE __temp__arbitrator_game');
        $this->addSql('CREATE INDEX IDX_A03E8B9D8C36C26A ON arbitrator_game (arbitrator_id)');
        $this->addSql('CREATE INDEX IDX_A03E8B9DE48FD905 ON arbitrator_game (game_id)');
        $this->addSql('DROP INDEX IDX_EA58D4D98A371DB4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ball_boy AS SELECT id, name FROM ball_boy');
        $this->addSql('DROP TABLE ball_boy');
        $this->addSql('CREATE TABLE ball_boy (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO ball_boy (id, name) SELECT id, name FROM __temp__ball_boy');
        $this->addSql('DROP TABLE __temp__ball_boy');
        $this->addSql('DROP INDEX IDX_95E3161F64FD12B8');
        $this->addSql('DROP INDEX IDX_95E3161FE48FD905');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ball_boy_game AS SELECT ball_boy_id, game_id FROM ball_boy_game');
        $this->addSql('DROP TABLE ball_boy_game');
        $this->addSql('CREATE TABLE ball_boy_game (ball_boy_id INTEGER NOT NULL, game_id INTEGER NOT NULL, PRIMARY KEY(ball_boy_id, game_id))');
        $this->addSql('INSERT INTO ball_boy_game (ball_boy_id, game_id) SELECT ball_boy_id, game_id FROM __temp__ball_boy_game');
        $this->addSql('DROP TABLE __temp__ball_boy_game');
        $this->addSql('CREATE INDEX IDX_95E3161F64FD12B8 ON ball_boy_game (ball_boy_id)');
        $this->addSql('CREATE INDEX IDX_95E3161FE48FD905 ON ball_boy_game (game_id)');
        $this->addSql('DROP INDEX IDX_E00CEDDE99E6F5DF');
        $this->addSql('DROP INDEX IDX_E00CEDDEE3184009');
        $this->addSql('CREATE TEMPORARY TABLE __temp__booking AS SELECT id, player_id, court_id, date_booking, hour_booking FROM booking');
        $this->addSql('DROP TABLE booking');
        $this->addSql('CREATE TABLE booking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, player_id INTEGER DEFAULT NULL, court_id INTEGER DEFAULT NULL, date_booking DATE NOT NULL, hour_booking VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO booking (id, player_id, court_id, date_booking, hour_booking) SELECT id, player_id, court_id, date_booking, hour_booking FROM __temp__booking');
        $this->addSql('DROP TABLE __temp__booking');
        $this->addSql('CREATE INDEX IDX_E00CEDDE99E6F5DF ON booking (player_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDEE3184009 ON booking (court_id)');
        $this->addSql('DROP INDEX IDX_232B318CAE363C0C');
        $this->addSql('DROP INDEX IDX_232B318CE3184009');
        $this->addSql('DROP INDEX IDX_232B318C9C24126');
        $this->addSql('CREATE TEMPORARY TABLE __temp__game AS SELECT id, chair_arbitrator_id, court_id, day_id, is_final, date, hour, score, is_double FROM game');
        $this->addSql('DROP TABLE game');
        $this->addSql('CREATE TABLE game (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chair_arbitrator_id INTEGER DEFAULT NULL, court_id INTEGER DEFAULT NULL, day_id INTEGER DEFAULT NULL, is_final BOOLEAN NOT NULL, date DATE NOT NULL, hour VARCHAR(255) NOT NULL, score VARCHAR(255) DEFAULT NULL, is_double BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO game (id, chair_arbitrator_id, court_id, day_id, is_final, date, hour, score, is_double) SELECT id, chair_arbitrator_id, court_id, day_id, is_final, date, hour, score, is_double FROM __temp__game');
        $this->addSql('DROP TABLE __temp__game');
        $this->addSql('CREATE INDEX IDX_232B318CAE363C0C ON game (chair_arbitrator_id)');
        $this->addSql('CREATE INDEX IDX_232B318CE3184009 ON game (court_id)');
        $this->addSql('CREATE INDEX IDX_232B318C9C24126 ON game (day_id)');
        $this->addSql('DROP INDEX IDX_2FF5CA33E48FD905');
        $this->addSql('DROP INDEX IDX_2FF5CA33296CD8AE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__game_team AS SELECT game_id, team_id FROM game_team');
        $this->addSql('DROP TABLE game_team');
        $this->addSql('CREATE TABLE game_team (game_id INTEGER NOT NULL, team_id INTEGER NOT NULL, PRIMARY KEY(game_id, team_id))');
        $this->addSql('INSERT INTO game_team (game_id, team_id) SELECT game_id, team_id FROM __temp__game_team');
        $this->addSql('DROP TABLE __temp__game_team');
        $this->addSql('CREATE INDEX IDX_2FF5CA33E48FD905 ON game_team (game_id)');
        $this->addSql('CREATE INDEX IDX_2FF5CA33296CD8AE ON game_team (team_id)');
        $this->addSql('DROP INDEX IDX_98197A65296CD8AE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__player AS SELECT id, team_id, nationality, first_name, last_name FROM player');
        $this->addSql('DROP TABLE player');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, team_id INTEGER DEFAULT NULL, nationality VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO player (id, team_id, nationality, first_name, last_name) SELECT id, team_id, nationality, first_name, last_name FROM __temp__player');
        $this->addSql('DROP TABLE __temp__player');
        $this->addSql('CREATE INDEX IDX_98197A65296CD8AE ON player (team_id)');
        $this->addSql('DROP INDEX IDX_813161BF99E6F5DF');
        $this->addSql('DROP INDEX IDX_813161BFE48FD905');
        $this->addSql('CREATE TEMPORARY TABLE __temp__player_game AS SELECT player_id, game_id FROM player_game');
        $this->addSql('DROP TABLE player_game');
        $this->addSql('CREATE TABLE player_game (player_id INTEGER NOT NULL, game_id INTEGER NOT NULL, PRIMARY KEY(player_id, game_id))');
        $this->addSql('INSERT INTO player_game (player_id, game_id) SELECT player_id, game_id FROM __temp__player_game');
        $this->addSql('DROP TABLE __temp__player_game');
        $this->addSql('CREATE INDEX IDX_813161BF99E6F5DF ON player_game (player_id)');
        $this->addSql('CREATE INDEX IDX_813161BFE48FD905 ON player_game (game_id)');
        $this->addSql('DROP INDEX UNIQ_3D8C939EEA750E8');
        $this->addSql('DROP INDEX UNIQ_3D8C939E77153098');
        $this->addSql('DROP INDEX UNIQ_3D8C939EC980D5C1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__promo_code AS SELECT id, ticket_type_id, label, code FROM promo_code');
        $this->addSql('DROP TABLE promo_code');
        $this->addSql('CREATE TABLE promo_code (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ticket_type_id INTEGER DEFAULT NULL, label VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO promo_code (id, ticket_type_id, label, code) SELECT id, ticket_type_id, label, code FROM __temp__promo_code');
        $this->addSql('DROP TABLE __temp__promo_code');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D8C939EEA750E8 ON promo_code (label)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D8C939E77153098 ON promo_code (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D8C939EC980D5C1 ON promo_code (ticket_type_id)');
        $this->addSql('DROP INDEX IDX_97A0ADA3A76ED395');
        $this->addSql('DROP INDEX IDX_97A0ADA3C980D5C1');
        $this->addSql('DROP INDEX IDX_97A0ADA32FAE4625');
        $this->addSql('DROP INDEX IDX_97A0ADA39C24126');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticket AS SELECT id, user_id, ticket_type_id, promo_code_id, day_id, date FROM ticket');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('CREATE TABLE ticket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, ticket_type_id INTEGER DEFAULT NULL, promo_code_id INTEGER DEFAULT NULL, day_id INTEGER DEFAULT NULL, date DATE NOT NULL)');
        $this->addSql('INSERT INTO ticket (id, user_id, ticket_type_id, promo_code_id, day_id, date) SELECT id, user_id, ticket_type_id, promo_code_id, day_id, date FROM __temp__ticket');
        $this->addSql('DROP TABLE __temp__ticket');
        $this->addSql('CREATE INDEX IDX_97A0ADA3A76ED395 ON ticket (user_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3C980D5C1 ON ticket (ticket_type_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA32FAE4625 ON ticket (promo_code_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA39C24126 ON ticket (day_id)');
        $this->addSql('DROP INDEX UNIQ_BE0542112FAE4625');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticket_type AS SELECT id, promo_code_id, label, price_percentage FROM ticket_type');
        $this->addSql('DROP TABLE ticket_type');
        $this->addSql('CREATE TABLE ticket_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, promo_code_id INTEGER DEFAULT NULL, label VARCHAR(255) NOT NULL, price_percentage DOUBLE PRECISION DEFAULT NULL)');
        $this->addSql('INSERT INTO ticket_type (id, promo_code_id, label, price_percentage) SELECT id, promo_code_id, label, price_percentage FROM __temp__ticket_type');
        $this->addSql('DROP TABLE __temp__ticket_type');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE0542112FAE4625 ON ticket_type (promo_code_id)');
    }
}
