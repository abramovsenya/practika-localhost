# Проект "Быстрые ноги" (служба доставки)

#### Для запуска:

1. данный проект должен находиться в папке /Applications/MAMP/htdocs/practika-localhost

2. Необходимо запустить Mamp (сервер)

```sh
php -S localhost:8000 &
```

3. в VSCode если пакеты и их зависимости у вас уже установлены то в терминале пишите:

```sh
npm run dev
```

Если связи не установлены то сначала:

```sh
 npm i
```

<!-- На всякий случай БД
CREATE TABLE `couriers` (
  `id_couriers` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `patronymic` varchar(50) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `reviews` varchar(10) NOT NULL
)
CREATE TABLE `deliveries` (
  `id_deliveries` int(11) NOT NULL,
  `id_orders` int(11) NOT NULL,
  `id_couriers` int(11) NOT NULL,
  `delivery_date` date NOT NULL,
  `status` varchar(50) NOT NULL
)
CREATE TABLE `orders` (
  `id_orders` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `total_cost` float(10,2) NOT NULL
)
CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `patronymic` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `bDate` varchar(10) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) DEFAULT NULL
) -->
