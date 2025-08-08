# WordPress Development Server with Nginx, MySQL, and WordPress
# All in one container for development purposes

FROM ubuntu:22.04

# Avoid prompts from apt
ENV DEBIAN_FRONTEND=noninteractive

# Install required packages
RUN apt-get update && apt-get install -y \
    nginx \
    mysql-server \
    php8.1-fpm \
    php8.1-mysql \
    php8.1-xml \
    php8.1-curl \
    php8.1-gd \
    php8.1-mbstring \
    php8.1-soap \
    php8.1-intl \
    php8.1-zip \
    php8.1-bcmath \
    php8.1-imagick \
    wget \
    curl \
    unzip \
    supervisor \
    && rm -rf /var/lib/apt/lists/*

# Create WordPress directory
RUN mkdir -p /var/www/html

# Download and install WordPress
RUN cd /tmp && \
    wget https://wordpress.org/latest.tar.gz && \
    tar -xzf latest.tar.gz && \
    mv wordpress/* /var/www/html/ && \
    rm -rf wordpress latest.tar.gz

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Configure MySQL
RUN mkdir -p /var/run/mysqld /var/lib/mysql /etc/mysql/conf.d
RUN chown mysql:mysql /var/run/mysqld /var/lib/mysql
RUN chmod 755 /var/run/mysqld /var/lib/mysql

# Copy MySQL configuration
COPY mysql.conf /etc/mysql/conf.d/wordpress.cnf
RUN chown mysql:mysql /etc/mysql/conf.d/wordpress.cnf
RUN chmod 644 /etc/mysql/conf.d/wordpress.cnf

# Configure PHP
RUN sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/' /etc/php/8.1/fpm/php.ini
RUN sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 64M/' /etc/php/8.1/fpm/php.ini
RUN sed -i 's/post_max_size = 8M/post_max_size = 64M/' /etc/php/8.1/fpm/php.ini

# Configure Nginx
COPY nginx.conf /etc/nginx/sites-available/default
RUN ln -sf /dev/stdout /var/log/nginx/access.log && \
    ln -sf /dev/stderr /var/log/nginx/error.log

# Configure Supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy custom theme
COPY custom-theme/ /var/www/custom-theme/

# Copy WordPress auto-configuration script
COPY wp-setup.sh /usr/local/bin/wp-setup.sh
RUN chmod +x /usr/local/bin/wp-setup.sh

# Expose port
EXPOSE 80

# Start services
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
