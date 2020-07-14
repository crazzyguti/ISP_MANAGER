CREATE DATABASE ispmanager CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `id11433928_ispmanager`.`work`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `work_date` DATETIME NOT NULL,
    `to` VARCHAR(100) NOT NULL,
    `description` TEXT NOT NULL,
    `college_id` BIGINT NOT NULL,
    `duration` TIME NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `update_at` DATETIME ON UPDATE CURRENT_TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY(`id`),
    INDEX `colege_index`(`college_id`)
) ENGINE = InnoDB;
