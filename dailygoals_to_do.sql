CREATE TABLE `dailygoals`.`dailygoals_to_do` 

( `id` INT NOT NULL AUTO_INCREMENT , 
`title` VARCHAR(255) NOT NULL , 
`description` TEXT NOT NULL , 
`completed` VARCHAR(5) NOT NULL , 
`failure` VARCHAR(5) NOT NULL , 
PRIMARY KEY (`id`)) 