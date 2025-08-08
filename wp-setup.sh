#!/bin/bash

# Wait for MySQL to be ready
echo "Waiting for MySQL to start..."
while ! mysqladmin ping --silent; do
    sleep 1
done

echo "MySQL is ready. Setting up WordPress database..."

# Wait a bit more for MySQL to fully initialize
sleep 3

# Ensure MySQL is fully initialized and set proper SQL mode for WordPress
mysql -e "SET GLOBAL sql_mode = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';" 2>/dev/null || true

# Create WordPress database and user with proper privileges
echo "Creating WordPress database and user..."
mysql -e "CREATE DATABASE IF NOT EXISTS wordpress;" 2>/dev/null || true
mysql -e "CREATE USER IF NOT EXISTS 'wordpress'@'localhost' IDENTIFIED BY 'wordpress123';" 2>/dev/null || true
mysql -e "CREATE USER IF NOT EXISTS 'wordpress'@'%' IDENTIFIED BY 'wordpress123';" 2>/dev/null || true
mysql -e "GRANT ALL PRIVILEGES ON wordpress.* TO 'wordpress'@'localhost';" 2>/dev/null || true
mysql -e "GRANT ALL PRIVILEGES ON wordpress.* TO 'wordpress'@'%';" 2>/dev/null || true
mysql -e "FLUSH PRIVILEGES;" 2>/dev/null || true

# Install WP-CLI
echo "Installing WP-CLI..."
cd /tmp
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
mv wp-cli.phar /usr/local/bin/wp

# Check if WordPress files exist, if not download them
echo "Checking for WordPress files..."
cd /var/www/html

# Configure WordPress
echo "Configuring WordPress..."

# Remove existing wp-config.php to force fresh configuration
rm -f wp-config.php

# Create wp-config.php with database settings using WP-CLI
if wp config create --dbname=wordpress --dbuser=wordpress --dbpass=wordpress123 --dbhost=localhost --allow-root; then
    echo "wp-config.php created successfully."
else
    echo "Failed to create wp-config.php, trying manual creation..."
    # Fallback to manual creation
    cp wp-config-sample.php wp-config.php
    sed -i "s/database_name_here/wordpress/" wp-config.php
    sed -i "s/username_here/wordpress/" wp-config.php
    sed -i "s/password_here/wordpress123/" wp-config.php
    sed -i "s/localhost/localhost/" wp-config.php
fi

# Set unique salts
wp config shuffle-salts --allow-root

# Always install WordPress to ensure database tables are created
echo "Installing WordPress..."
    
# First, ensure the database is clean
wp db reset --yes --allow-root 2>/dev/null || true

# Install WordPress core
if wp core install --url=http://localhost:8080 --title="Development WordPress Site" --admin_user=admin --admin_password=admin123 --admin_email=admin@example.com --skip-email --allow-root; then
    echo "WordPress installation completed."
else
    echo "WordPress installation failed. Retrying..."
    # Retry once more
    sleep 5
    wp core install --url=http://localhost:8080 --title="Development WordPress Site" --admin_user=admin --admin_password=admin123 --admin_email=admin@example.com --skip-email --allow-root || {
        echo "WordPress installation failed after retry."
        exit 1
    }
    echo "WordPress installation completed on retry."
fi

# Copy custom theme
echo "Copying custom theme..."
cp -r /var/www/custom-theme/wpdevserver /var/www/html/wp-content/themes/

# Activate custom theme
echo "Activating custom theme..."
wp theme activate wpdevserver --allow-root

echo "WordPress setup completed successfully!"

# Keep the script running to prevent supervisor from restarting it
tail -f /dev/null
