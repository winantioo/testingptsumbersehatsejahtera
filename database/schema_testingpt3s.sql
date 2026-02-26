CREATE DATABASE IF NOT EXISTS testingpt3s CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE testingpt3s;

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS product_categories;
DROP TABLE IF EXISTS careers;
DROP TABLE IF EXISTS sales_contacts;
SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE product_categories (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(150) NOT NULL UNIQUE,
  name_id VARCHAR(150) NOT NULL,
  name_en VARCHAR(150) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

CREATE TABLE products (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  category_id BIGINT UNSIGNED NOT NULL,
  manufacturer VARCHAR(255) NULL,
  image_path VARCHAR(255) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  INDEX idx_products_category_name (category_id, name),
  CONSTRAINT fk_products_category
    FOREIGN KEY (category_id) REFERENCES product_categories(id)
    ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE careers (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title_id VARCHAR(255) NOT NULL,
  title_en VARCHAR(255) NOT NULL,
  description_id TEXT NULL,
  description_en TEXT NULL,
  apply_url VARCHAR(500) NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

CREATE TABLE sales_contacts (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  area_id VARCHAR(255) NOT NULL,
  whatsapp VARCHAR(30) NOT NULL,
  photo_path VARCHAR(255) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

INSERT INTO product_categories (slug, name_id, name_en, created_at, updated_at) VALUES
('tablet','Tablet','Tablet',NOW(),NOW()),
('kaplet','Kaplet','Caplet',NOW(),NOW()),
('kb-dan-injeksi','KB dan Injeksi','Family Planning & Injection',NOW(),NOW()),
('syrup','Syrup','Syrup',NOW(),NOW()),
('vitamin','Vitamin','Vitamins',NOW(),NOW()),
('jamu','Jamu','Herbal (Jamu)',NOW(),NOW()),
('obat-cina','Obat Cina','Traditional Chinese Medicine',NOW(),NOW()),
('otc','OTC','OTC',NOW(),NOW());
