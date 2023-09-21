# JWT Example

# Install
git clone https://github.com/elpmisz/jwt-example \
composer update

# Create Database
CREATE TABLE `users` ( \
  `id` int(11) NOT NULL, \
  `name` varchar(100) NOT NULL, \
  `email` varchar(100) NOT NULL, \
  `password` varchar(255) NOT NULL, \
  `level` int(1) NOT NULL DEFAULT '1', \
  `created` DATETIME DEFAULT CURRENT_TIMESTAMP \
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 

ALTER TABLE `users` \
  ADD PRIMARY KEY (`id`), \
  ADD UNIQUE KEY `email` (`email`); 

ALTER TABLE `users` \
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT; 

INSERT INTO  \
  `users` (`id`, `name`, `email`, `password`,`level`)  \
VALUES \
  (1, 'admin', 'admin@test.com', '$2y$15$B6SdL0.Z.t17Ant9w5ns4.Hgm9Bj7MlMfUBYHjpqYJ1ZJpqsQxIOq', 9), \
  (2, 'user', 'user@test.com', '$2y$15$B6SdL0.Z.t17Ant9w5ns4.Hgm9Bj7MlMfUBYHjpqYJ1ZJpqsQxIOq', 1); 
