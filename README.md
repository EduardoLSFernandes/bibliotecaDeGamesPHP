# bibliotecaDeGamesPHP
Biblioteca de jogos utilizando PHP Orientado a Objetos

Instruções para criar DB:

CREATE TABLE `crud_games`.`games` ( `id` INT(11) NOT NULL AUTO_INCREMENT ,
`titulo` VARCHAR(255) NOT NULL ,
`descricao` TEXT NOT NULL ,
`status` ENUM('j','f') NOT NULL ,
`data` TIMESTAMP NOT NULL ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;
