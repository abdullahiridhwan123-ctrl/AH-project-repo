-- Creating a table for the account with the following columns:
CREATE TABLE IF NOT EXISTS `accounts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(100) NOT NULL,
    `registered` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Creating a table for the orders with the following columns:
CREATE TABLE IF NOT EXISTS `orders` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
    `product` varchar(50) NOT NULL,
    `colour` varchar(30) NOT NULL,
    `size` varchar(15) NOT NULL,
    `quantity` varchar(15) NOT NULL,
    `comment` varchar(600) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;