# Используем официальный образ PHP в качестве базового
FROM php:8.2-cli

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Устанавливаем системные зависимости и PHP расширения
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo mbstring exif pcntl bcmath gd

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копируем файлы приложения
COPY . /var/www/html

# Устанавливаем зависимости приложения
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Открываем порт 80
EXPOSE 80

# Запускаем встроенный сервер PHP на порту 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "web/"]
