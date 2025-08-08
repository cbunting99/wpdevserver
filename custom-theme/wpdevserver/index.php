<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_Dev_Server
 */

get_header();
?>

<main class="wpdev-main">
    <div class="wpdev-container">
        <div class="wpdev-header">
            <h1>WordPress Development Server</h1>
            <p class="wpdev-subtitle">Ready for Development</p>
        </div>

        <div class="wpdev-content">
            <div class="wpdev-section">
                <h2>Welcome, Developer!</h2>
                <p>This is your custom WordPress development environment. Everything is configured and ready for you to start building amazing WordPress sites.</p>
            </div>

            <div class="wpdev-quick-links">
                <h3>Quick Access</h3>
                <div class="wpdev-links-grid">
                    <a href="/wp-admin/" class="wpdev-link-card">
                        <h4>WordPress Admin</h4>
                        <p>Access the WordPress dashboard</p>
                        <span class="wpdev-link-url">/wp-admin/</span>
                    </a>
                    <a href="/wp-admin/customize.php" class="wpdev-link-card">
                        <h4>Customizer</h4>
                        <p>Customize your site appearance</p>
                        <span class="wpdev-link-url">/wp-admin/customize.php</span>
                    </a>
                    <a href="/wp-admin/plugins.php" class="wpdev-link-card">
                        <h4>Plugins</h4>
                        <p>Manage plugins</p>
                        <span class="wpdev-link-url">/wp-admin/plugins.php</span>
                    </a>
                    <a href="/wp-admin/themes.php" class="wpdev-link-card">
                        <h4>Themes</h4>
                        <p>Manage themes</p>
                        <span class="wpdev-link-url">/wp-admin/themes.php</span>
                    </a>
                </div>
            </div>

            <div class="wpdev-info-section">
                <h3>Development Server Information</h3>
                <div class="wpdev-info-grid">
                    <div class="wpdev-info-item">
                        <strong>Server Status:</strong>
                        <span class="wpdev-status-success">Running</span>
                    </div>
                    <div class="wpdev-info-item">
                        <strong>Database:</strong>
                        <span>MySQL Connected</span>
                    </div>
                    <div class="wpdev-info-item">
                        <strong>PHP Version:</strong>
                        <span><?php echo phpversion(); ?></span>
                    </div>
                    <div class="wpdev-info-item">
                        <strong>WordPress Version:</strong>
                        <span><?php echo get_bloginfo('version'); ?></span>
                    </div>
                </div>
            </div>

            <div class="wpdev-credentials">
                <h3>Default Credentials</h3>
                <div class="wpdev-creds-grid">
                    <div class="wpdev-cred-item">
                        <strong>Admin Username:</strong>
                        <code>admin</code>
                    </div>
                    <div class="wpdev-cred-item">
                        <strong>Admin Password:</strong>
                        <code>admin123</code>
                    </div>
                </div>
                <p class="wpdev-creds-note">⚠️ Remember to change these credentials in production!</p>
            </div>
        </div>
    </div>
</main>

<style>
html, body {
    margin: 0;
    padding: 0;
}

#page, #content, .site, .site-content {
    margin: 0;
    padding: 0;
}

.wpdev-main {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    line-height: 1.6;
    color: #333;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 0;
    margin: 0;
}

.wpdev-container {
    max-width: 1200px;
    margin: 0 auto;
    background: white;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    overflow: hidden;
}

.wpdev-header {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    text-align: center;
    padding: 40px 0;
}

.wpdev-header h1 {
    margin: 0;
    font-size: 2.5em;
    font-weight: 300;
}

.wpdev-subtitle {
    font-size: 1.2em;
    opacity: 0.9;
    margin: 10px 0 0 0;
}

.wpdev-content {
    padding: 40px;
}

.wpdev-section h2 {
    color: #2c3e50;
    margin-top: 0;
}

.wpdev-quick-links {
    margin: 40px 0;
}

.wpdev-quick-links h3 {
    color: #2c3e50;
    margin-bottom: 20px;
}

.wpdev-links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.wpdev-link-card {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
}

.wpdev-link-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-color: #3498db;
}

.wpdev-link-card h4 {
    margin: 0 0 10px 0;
    color: #2c3e50;
}

.wpdev-link-card p {
    margin: 0 0 10px 0;
    color: #666;
    font-size: 0.9em;
}

.wpdev-link-url {
    font-size: 0.8em;
    color: #3498db;
    font-family: monospace;
}

.wpdev-info-section {
    margin: 40px 0;
}

.wpdev-info-section h3 {
    color: #2c3e50;
    margin-bottom: 20px;
}

.wpdev-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.wpdev-info-item {
    background: #e8f4f8;
    padding: 15px;
    border-radius: 5px;
}

.wpdev-info-item strong {
    display: block;
    color: #2c3e50;
    margin-bottom: 5px;
}

.wpdev-status-success {
    color: #27ae60;
    font-weight: bold;
}

.wpdev-credentials {
    margin: 40px 0;
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    border-radius: 8px;
    padding: 20px;
}

.wpdev-credentials h3 {
    color: #2c3e50;
    margin-top: 0;
}

.wpdev-creds-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin: 15px 0;
}

.wpdev-cred-item {
    background: #fef9e7;
    padding: 15px;
    border-radius: 5px;
}

.wpdev-cred-item strong {
    display: block;
    color: #2c3e50;
    margin-bottom: 5px;
}

.wpdev-cred-item code {
    background: #fff;
    padding: 2px 6px;
    border-radius: 3px;
    font-family: monospace;
}

.wpdev-creds-note {
    font-size: 0.9em;
    color: #856404;
    margin: 10px 0 0 0;
    font-style: italic;
}

@media (max-width: 768px) {
    .wpdev-content {
        padding: 20px;
    }
    
    .wpdev-header h1 {
        font-size: 2em;
    }
    
    .wpdev-links-grid,
    .wpdev-info-grid,
    .wpdev-creds-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php
get_footer();
?>
