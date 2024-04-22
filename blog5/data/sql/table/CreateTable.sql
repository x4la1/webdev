CREATE TABLE `post` (
    `id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(255),
    `subtitle` VARCHAR(255),
    `content` TEXT NOT NULL,
    `author` VARCHAR(255),
    `author_url` VARCHAR(255),
    `publishdate` VARCHAR(255),
    `image_url` VARCHAR(255),
    `featured` TINYINT(1) DEFAULT 0
);