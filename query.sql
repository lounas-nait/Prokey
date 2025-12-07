CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100)
);


CREATE TABLE password_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(50) NOT NULL,
    color VARCHAR(7)
);

CREATE TABLE password_type_fields (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_id INT NOT NULL,
    field_name VARCHAR(100) NOT NULL,
    field_label VARCHAR(100) NOT NULL,
    field_type VARCHAR(50) DEFAULT 'text',
    sort_order INT DEFAULT 0,

    FOREIGN KEY (type_id) REFERENCES password_types(id) ON DELETE CASCADE
);

CREATE TABLE passwords (
    id INT AUTO_INCREMENT PRIMARY KEY,

    project_id INT NOT NULL,
    type_id INT NOT NULL,
    label VARCHAR(100) NOT NULL,

    extra JSON DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (type_id) REFERENCES password_types(id)
);



CREATE TABLE files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    password_id INT NOT NULL,

    filename VARCHAR(255) NOT NULL,    
    stored_name VARCHAR(255) NOT NULL, 
    mime_type VARCHAR(255) NOT NULL,
    size INT NOT NULL,
    encrypted TINYINT DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (password_id) REFERENCES passwords(id) ON DELETE CASCADE
);


INSERT INTO `users` (`id`, `email`, `password`, `name`) VALUES
(1, 'admin@test.com', '$2y$10$MrgKzApkZYJNbgWzTTHgXOYLFCefeyP7xhpAnXDyaLoxLfmwSfUTa', 'Admin'),
(2, 'admin00@test.com', '$2y$10$XtiGq9X1xgXATyZVRdXUY.Sux52Q4F0atLaxNnBeYZlmKunuEoR4m', 'Admin00');


INSERT INTO password_types (id, label, color)
VALUES
(1, 'SSH Key', '#9b59b6'),
(2, 'Certificat', '#e67e22'),
(3, 'Fichier TXT', '#3498db');


-- Champs pour Mot de passe
INSERT INTO password_type_fields (password_type_id, label, field_name)
VALUES
(2, 'Login', 'login'),
(2, 'Mot de passe', 'password');

-- Champs pour SSH Key
INSERT INTO password_type_fields (password_type_id, label, field_name)
VALUES
(1, 'Nom de la clé', 'key_name'),
(1, 'Clé privée', 'private_key');

-- Champs pour Certificat
INSERT INTO password_type_fields (password_type_id, label, field_name)
VALUES
(3, 'Nom du certificat', 'cert_name'),
(3, 'Clé privée', 'private_key');


-- Champs pour SSH Key
INSERT INTO password_type_fields (type_id, field_name, field_label, field_type, sort_order)
VALUES
(1, 'key_name', 'Nom de la clé', 'text', 1),
(1, 'private_key', 'Clé privée', 'text', 2);

-- Champs pour Certificat
INSERT INTO password_type_fields (type_id, field_name, field_label, field_type, sort_order)
VALUES
(2, 'cert_name', 'Nom du certificat', 'text', 1),
(2, 'private_key', 'Clé privée', 'text', 2);

-- Champs pour Fichier TXT
INSERT INTO password_type_fields (type_id, field_name, field_label, field_type, sort_order)
VALUES
(3, 'file_name', 'Nom du fichier', 'text', 1),
(3, 'file_content', 'Contenu du fichier', 'textarea', 2);



ALTER TABLE passwords ADD level VARCHAR(20) NULL;
