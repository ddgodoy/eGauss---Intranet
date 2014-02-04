CREATE TABLE app_user (id INT AUTO_INCREMENT, name VARCHAR(100), last_name VARCHAR(100), email VARCHAR(200) NOT NULL, phone VARCHAR(50) NOT NULL, skype VARCHAR(50), contact_time_from VARCHAR(50) NOT NULL, contact_time_to VARCHAR(50) NOT NULL, photo VARCHAR(50), salt VARCHAR(100), password VARCHAR(100), recover_token VARCHAR(100), enabled TINYINT(1) DEFAULT '1', last_access datetime, company_id INT NOT NULL, user_role_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX company_id_idx (company_id), INDEX user_role_id_idx (user_role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE app_user_registered_companies (id INT AUTO_INCREMENT, app_user_id INT, registered_companies_id INT, notified TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX app_user_id_idx (app_user_id), INDEX registered_companies_id_idx (registered_companies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE billing (id INT AUTO_INCREMENT, year BIGINT NOT NULL, month BIGINT NOT NULL, total_affiliated DECIMAL(9, 2), sale_of_affiliated DECIMAL(9, 2), total_consultancy DECIMAL(9, 2), consultancy DECIMAL(9, 2), total_intermediation DECIMAL(9, 2), intermediation DECIMAL(9, 2), total_formation DECIMAL(9, 2), formation DECIMAL(9, 2), total_patents DECIMAL(9, 2), patents DECIMAL(9, 2), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE calendar (id INT AUTO_INCREMENT, app_user_id INT NOT NULL, year BIGINT NOT NULL, month BIGINT NOT NULL, day BIGINT NOT NULL, hour_from VARCHAR(50) NOT NULL, hour_to VARCHAR(50) NOT NULL, subject text, body text, type_calendar_id INT NOT NULL, registered_companies_id INT, next TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX app_user_id_idx (app_user_id), INDEX registered_companies_id_idx (registered_companies_id), INDEX type_calendar_id_idx (type_calendar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE company (id INT AUTO_INCREMENT, name VARCHAR(50) NOT NULL, email VARCHAR(200), address VARCHAR(100), phone VARCHAR(50), logo VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE contracts_intermediation (id INT AUTO_INCREMENT, year BIGINT NOT NULL, month BIGINT NOT NULL, day BIGINT NOT NULL, customer VARCHAR(50) NOT NULL, app_user_id INT NOT NULL, observations text, business_amount DECIMAL(9, 2), intermediation DECIMAL(9, 2), final_commission DECIMAL(9, 2), comments text, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX app_user_id_idx (app_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE documents_registered_companies (id INT AUTO_INCREMENT, name VARCHAR(50) NOT NULL, icon VARCHAR(200) NOT NULL, url VARCHAR(200) NOT NULL, registered_companies_id INT NOT NULL, information_id INT, type_information_id INT, calendar_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX registered_companies_id_idx (registered_companies_id), INDEX information_id_idx (information_id), INDEX type_information_id_idx (type_information_id), INDEX calendar_id_idx (calendar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE information (id INT AUTO_INCREMENT, date datetime NOT NULL, name VARCHAR(50) NOT NULL, description text, registered_companies_id INT, type_information_id INT, important TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX registered_companies_id_idx (registered_companies_id), INDEX type_information_id_idx (type_information_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE notifications (id INT AUTO_INCREMENT, registered_companies_id INT, information_id INT, contracts_intermediation_id INT, app_user_id INT, type VARCHAR(50) NOT NULL, subject text, important TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX registered_companies_id_idx (registered_companies_id), INDEX information_id_idx (information_id), INDEX contracts_intermediation_id_idx (contracts_intermediation_id), INDEX app_user_id_idx (app_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE registered_companies (id INT AUTO_INCREMENT, date datetime, name VARCHAR(50) NOT NULL, description text, website VARCHAR(250), email VARCHAR(200), address VARCHAR(100), phone VARCHAR(50), skype VARCHAR(50), logo VARCHAR(50), code VARCHAR(150) NOT NULL, contact_first_name VARCHAR(30), contact_last_name VARCHAR(30), contact_phone VARCHAR(50), contact_email VARCHAR(200), type_companies_id INT NOT NULL, comments text, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX type_companies_id_idx (type_companies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE temps_documents (id INT AUTO_INCREMENT, name VARCHAR(50) NOT NULL, icon VARCHAR(200) NOT NULL, url VARCHAR(200) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE type_calendar (id INT AUTO_INCREMENT, name VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE type_companies (id INT AUTO_INCREMENT, name VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE type_information (id INT AUTO_INCREMENT, name VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE user_role (id INT AUTO_INCREMENT, name VARCHAR(50) NOT NULL, credentials VARCHAR(250), code VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE videos_registered_companies (id INT AUTO_INCREMENT, name VARCHAR(50) NOT NULL, url VARCHAR(200) NOT NULL, registered_companies_id INT NOT NULL, information_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX registered_companies_id_idx (registered_companies_id), INDEX information_id_idx (information_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
ALTER TABLE app_user ADD CONSTRAINT app_user_user_role_id_user_role_id FOREIGN KEY (user_role_id) REFERENCES user_role(id) ON DELETE CASCADE;
ALTER TABLE app_user ADD CONSTRAINT app_user_company_id_company_id FOREIGN KEY (company_id) REFERENCES company(id) ON DELETE CASCADE;
ALTER TABLE app_user_registered_companies ADD CONSTRAINT arri FOREIGN KEY (registered_companies_id) REFERENCES registered_companies(id) ON DELETE SET NULL;
ALTER TABLE app_user_registered_companies ADD CONSTRAINT app_user_registered_companies_app_user_id_app_user_id FOREIGN KEY (app_user_id) REFERENCES app_user(id) ON DELETE SET NULL;
ALTER TABLE calendar ADD CONSTRAINT calendar_type_calendar_id_type_calendar_id FOREIGN KEY (type_calendar_id) REFERENCES type_calendar(id) ON DELETE CASCADE;
ALTER TABLE calendar ADD CONSTRAINT calendar_registered_companies_id_registered_companies_id FOREIGN KEY (registered_companies_id) REFERENCES registered_companies(id) ON DELETE CASCADE;
ALTER TABLE calendar ADD CONSTRAINT calendar_app_user_id_app_user_id FOREIGN KEY (app_user_id) REFERENCES app_user(id) ON DELETE CASCADE;
ALTER TABLE contracts_intermediation ADD CONSTRAINT contracts_intermediation_app_user_id_app_user_id FOREIGN KEY (app_user_id) REFERENCES app_user(id);
ALTER TABLE documents_registered_companies ADD CONSTRAINT dtti FOREIGN KEY (type_information_id) REFERENCES type_information(id) ON DELETE CASCADE;
ALTER TABLE documents_registered_companies ADD CONSTRAINT drri FOREIGN KEY (registered_companies_id) REFERENCES registered_companies(id) ON DELETE CASCADE;
ALTER TABLE documents_registered_companies ADD CONSTRAINT documents_registered_companies_information_id_information_id FOREIGN KEY (information_id) REFERENCES information(id) ON DELETE SET NULL;
ALTER TABLE documents_registered_companies ADD CONSTRAINT documents_registered_companies_calendar_id_calendar_id FOREIGN KEY (calendar_id) REFERENCES calendar(id) ON DELETE CASCADE;
ALTER TABLE information ADD CONSTRAINT information_type_information_id_type_information_id FOREIGN KEY (type_information_id) REFERENCES type_information(id) ON DELETE CASCADE;
ALTER TABLE information ADD CONSTRAINT information_registered_companies_id_registered_companies_id FOREIGN KEY (registered_companies_id) REFERENCES registered_companies(id) ON DELETE CASCADE;
ALTER TABLE notifications ADD CONSTRAINT notifications_registered_companies_id_registered_companies_id FOREIGN KEY (registered_companies_id) REFERENCES registered_companies(id) ON DELETE CASCADE;
ALTER TABLE notifications ADD CONSTRAINT notifications_information_id_information_id FOREIGN KEY (information_id) REFERENCES information(id) ON DELETE SET NULL;
ALTER TABLE notifications ADD CONSTRAINT notifications_app_user_id_app_user_id FOREIGN KEY (app_user_id) REFERENCES app_user(id) ON DELETE SET NULL;
ALTER TABLE notifications ADD CONSTRAINT ncci FOREIGN KEY (contracts_intermediation_id) REFERENCES contracts_intermediation(id) ON DELETE SET NULL;
ALTER TABLE registered_companies ADD CONSTRAINT registered_companies_type_companies_id_type_companies_id FOREIGN KEY (type_companies_id) REFERENCES type_companies(id) ON DELETE CASCADE;
ALTER TABLE videos_registered_companies ADD CONSTRAINT vrri FOREIGN KEY (registered_companies_id) REFERENCES registered_companies(id) ON DELETE CASCADE;
ALTER TABLE videos_registered_companies ADD CONSTRAINT videos_registered_companies_information_id_information_id FOREIGN KEY (information_id) REFERENCES information(id) ON DELETE SET NULL;
