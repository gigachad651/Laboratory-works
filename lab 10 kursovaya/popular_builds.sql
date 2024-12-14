CREATE TABLE `popular_builds` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,               
  `price` DECIMAL(10,2) NOT NULL,             
  `description` TEXT NOT NULL,                
  `is_active` TINYINT(1) DEFAULT 1,           
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Вставка данных для сборок
INSERT INTO `popular_builds` (`name`, `price`, `description`, `is_active`) VALUES
('Сборка для игр 2024', 45000.00, 'Мощная игровая сборка для современных игр.', 1),
('Рабочая станция', 60000.00, 'Компьютер для работы с графикой и видео.', 1),
('Бюджетная сборка', 25000.00, 'Доступная по цене сборка для повседневных задач.', 1),
('Сборка для программирования', 40000.00, 'Компьютер для разработки программного обеспечения.', 1);
