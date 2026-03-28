# Installation Guide / Інструкція з встановлення

## Requirements / Вимоги
- WordPress 6.0+
- PHP 8.0+
- MySQL 5.7+

## Required Plugins / Необхідні плагіни
- **Advanced Custom Fields (ACF)** — for content fields
- **Polylang** — for bilingual support (UA/EN)

## Quick Install / Швидке встановлення

### 1. Install WordPress
Set up a fresh WordPress installation.

### 2. Install Theme
Copy the theme folder to `wp-content/themes/sarcoma-theme/` and activate it in WordPress admin.

### 3. Import Database (optional)
If you want all pages, cases, and content pre-configured:

1. Create a new database or use existing one
2. Import `database.sql`:
   ```
   mysql -u root -p your_database < database.sql
   ```
3. **IMPORTANT:** Replace URLs in the database to match your site:
   ```sql
   UPDATE wp_options SET option_value = REPLACE(option_value, 'http://localhost/gproject', 'http://YOUR_SITE_URL') WHERE option_name IN ('siteurl', 'home');
   ```
   Or use the **Better Search Replace** plugin to replace `http://localhost/gproject` with your site URL across all tables.

4. Update `wp-config.php` with your database credentials.

### 4. Install Plugins
- Install and activate **ACF** (Advanced Custom Fields)
- Install and activate **Polylang**

### 5. Login
Default admin credentials from the dump:
- URL: `http://YOUR_SITE/wp-admin`
- Login: check wp_users table

## Notes
- Theme works without plugins but with limited functionality
- Without ACF: content fields won't show
- Without Polylang: site works in Ukrainian only (no language switcher)
- Payment gateways (LiqPay, WayForPay) require API keys configured in ACF options
- Monobank jar link is hardcoded in `functions.php` (`SARCOMA_DONATE_URL`)
