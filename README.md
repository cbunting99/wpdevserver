<!--
README.md

WordPress Development Server with Docker
- Single container setup with Nginx, MySQL, and WordPress
- Auto-configured with default admin credentials
- Development-ready environment for WordPress

Features:
- All services in one container for simplicity
- Automatic WordPress installation and configuration
- Pre-configured admin account (admin/admin123)
- Persistent data storage
- Easy start/stop with Docker Compose

Author: Chris Bunting
Created: 2025-08-07
Last Modified: 2025-08-08
Version: 1.0.0

Copyright (c) 2025 Chris Bunting. All rights reserved.
-->

# ⚠️ LOCAL DEVELOPMENT ONLY

**This project was created by Chris Bunting for local development purposes only.**  
**⚠️ Security Notice: Default passwords are used during automated setup. Do not deploy to production or expose to the internet.**

# WordPress Development Server

A complete WordPress development environment running in a single Docker container with Nginx, MySQL, and WordPress pre-configured.

## Features

- **Single Container**: Nginx, MySQL, and WordPress all running in one container
- **Auto-Configured**: WordPress is automatically installed and configured
- **Default Admin**: Pre-configured admin account (`admin` / `admin123`)
- **Persistent Data**: WordPress files and database data persist between container restarts
- **Easy Management**: Simple Docker Compose setup for starting/stopping

## Prerequisites

- Docker installed on your system
- Docker Compose installed on your system

## Quick Start

1. **Build the container:**
   ```bash
   docker-compose build
   ```

2. **Start the container:**
   ```bash
   docker-compose up -d
   ```

3. **Access WordPress:**
   - Open your browser and go to `http://localhost:8080`
   - Login with:
     - Username: `admin`
     - Password: `admin123`

4. **Stop the container:**
   ```bash
   docker-compose down
   ```

## Project Structure

```
wpdevserver/
├── Dockerfile          # Container definition
├── docker-compose.yml  # Container management
├── nginx.conf         # Nginx configuration
├── supervisord.conf   # Process management
├── wp-setup.sh        # WordPress auto-configuration script
├── wordpress-data/    # Persistent WordPress files (created automatically)
└── README.md          # This file
```

## Configuration

### Ports
- **8080**: WordPress web interface

### Default Credentials
- **WordPress Admin**: 
  - Username: `admin`
  - Password: `admin123`

### Database
- **Database Name**: `wordpress`
- **Database User**: `wordpress`
- **Database Password**: `wordpress123`
- **Database Host**: `localhost`

## Data Persistence

All WordPress data is stored in the `wordpress-data` directory:
- WordPress files: `wordpress-data/`
- Database is stored within the container but persists through restarts

## Troubleshooting

### Container won't start
```bash
docker-compose logs wordpress-dev
```

### Reset everything (WARNING: This will delete all data)
```bash
docker-compose down -v
rm -rf wordpress-data
docker-compose up -d
```

### Access container shell
```bash
docker exec -it wordpress-dev-server bash
```

## Customization

### Change Port
Edit `docker-compose.yml` and modify the ports section:
```yaml
ports:
  - "8080:80"  # Change 8080 to your desired port
```

### Change Admin Password
After WordPress is running, login and change the password through the WordPress admin interface.

## Development Notes

This setup is designed for development purposes only. It is not suitable for production use due to:
- Single container architecture (not following Docker best practices)
- Default credentials
- No SSL/HTTPS configuration
- No security hardening

For production deployments, consider using separate containers for each service.

---

## Made with ❤️ by Chris Bunting

This project was created with care by Chris Bunting for local WordPress development.  
For questions or contributions, please visit the [GitHub repository](https://github.com/cbunting99/wpdevserver).
