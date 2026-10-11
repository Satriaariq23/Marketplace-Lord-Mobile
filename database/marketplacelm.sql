CREATE DATABASE IF NOT EXISTS marketplacelm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE marketplacelm;

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(30) NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) NOT NULL DEFAULT 0,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

CREATE TABLE password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL
) ENGINE=InnoDB;

CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX sessions_user_id_index (user_id),
    INDEX sessions_last_activity_index (last_activity)
) ENGINE=InnoDB;

CREATE TABLE cache (
    `key` VARCHAR(255) PRIMARY KEY,
    value MEDIUMTEXT NOT NULL,
    expiration INT NOT NULL,
    INDEX cache_expiration_index (expiration)
) ENGINE=InnoDB;

CREATE TABLE cache_locks (
    `key` VARCHAR(255) PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration INT NOT NULL,
    INDEX cache_locks_expiration_index (expiration)
) ENGINE=InnoDB;

CREATE TABLE jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload LONGTEXT NOT NULL,
    attempts TINYINT UNSIGNED NOT NULL,
    reserved_at INT UNSIGNED NULL,
    available_at INT UNSIGNED NOT NULL,
    created_at INT UNSIGNED NOT NULL,
    INDEX jobs_queue_index (queue)
) ENGINE=InnoDB;

CREATE TABLE job_batches (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    total_jobs INT NOT NULL,
    pending_jobs INT NOT NULL,
    failed_jobs INT NOT NULL,
    failed_job_ids LONGTEXT NOT NULL,
    options MEDIUMTEXT NULL,
    cancelled_at INT NULL,
    created_at INT NOT NULL,
    finished_at INT NULL
) ENGINE=InnoDB;

CREATE TABLE failed_jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255) NOT NULL UNIQUE,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload LONGTEXT NOT NULL,
    exception LONGTEXT NOT NULL,
    failed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE products (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    category VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL,
    price BIGINT UNSIGNED NOT NULL,
    stock INT UNSIGNED NOT NULL DEFAULT 0,
    image_path VARCHAR(255) NULL,
    video_path VARCHAR(255) NULL,
    whatsapp_number VARCHAR(30) NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX products_category_index (category),
    INDEX products_is_active_index (is_active)
) ENGINE=InnoDB;

CREATE TABLE orders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_code VARCHAR(255) NOT NULL UNIQUE,
    user_id BIGINT UNSIGNED NOT NULL,
    product_id BIGINT UNSIGNED NOT NULL,
    amount BIGINT UNSIGNED NOT NULL,
    status VARCHAR(255) NOT NULL DEFAULT 'pending',
    midtrans_transaction_id VARCHAR(255) NULL,
    midtrans_snap_token VARCHAR(255) NULL,
    midtrans_redirect_url TEXT NULL,
    meta JSON NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX orders_status_index (status),
    INDEX orders_midtrans_transaction_id_index (midtrans_transaction_id),
    CONSTRAINT orders_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT orders_product_id_foreign FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO users (name, email, phone, password, is_admin, created_at, updated_at)
VALUES
('Admin Marketplace', 'admin@marketplacelm.test', '6281234567890', '$2y$12$0VwJfJvtxMxf1Ne44YwCo.p8lNjf62K5hRFY3eXxSNaben7nuPhYu', 1, NOW(), NOW()),
('Buyer Demo', 'buyer@marketplacelm.test', '628111222333', '$2y$12$0VwJfJvtxMxf1Ne44YwCo.p8lNjf62K5hRFY3eXxSNaben7nuPhYu', 0, NOW(), NOW());
