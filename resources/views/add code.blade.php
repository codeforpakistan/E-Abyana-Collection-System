-- Table: Division
CREATE TABLE divisions (
    div_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Table: District
CREATE TABLE districts (
    district_id INT AUTO_INCREMENT PRIMARY KEY,
    div_id INT NOT NULL,
    dist_name VARCHAR(255) NOT NULL,
    FOREIGN KEY (div_id) REFERENCES divisions(div_id)
);

-- Table: Tehsil
CREATE TABLE tehsils (
    tehsil_id INT AUTO_INCREMENT PRIMARY KEY,
    district_id INT NOT NULL,
    tehsil_name VARCHAR(255) NOT NULL,
    FOREIGN KEY (district_id) REFERENCES districts(district_id)
);

-- Table: Halqa
CREATE TABLE halqas (
    halqa_id INT AUTO_INCREMENT PRIMARY KEY,
    halqa_name VARCHAR(255) NOT NULL,
    tehsil_id INT NOT NULL,
    FOREIGN KEY (tehsil_id) REFERENCES tehsils(tehsil_id)
);

-- Table: Patwari
CREATE TABLE patwaris (
    patwari_id INT AUTO_INCREMENT PRIMARY KEY,
    patwari_name VARCHAR(255) NOT NULL,
    halqa_id INT NOT NULL,
    FOREIGN KEY (halqa_id) REFERENCES halqas(halqa_id)
);

-- Table: Village
CREATE TABLE villages (
    village_id INT AUTO_INCREMENT PRIMARY KEY,
    village_name VARCHAR(255) NOT NULL,
    patwari_id INT NOT NULL,
    FOREIGN KEY (patwari_id) REFERENCES patwaris(patwari_id)
);

-- Table: Canal
CREATE TABLE canals (
    canal_id INT AUTO_INCREMENT PRIMARY KEY,
    canal_name VARCHAR(255) NOT NULL,
    village_id INT NOT NULL,
    FOREIGN KEY (village_id) REFERENCES villages(village_id)
);

-- Table: Outlet
CREATE TABLE outlets (
    outlet_id INT AUTO_INCREMENT PRIMARY KEY,
    outlet_name VARCHAR(255) NOT NULL,
    village_canal INT NOT NULL,
    FOREIGN KEY (village_canal) REFERENCES canals(canal_id)
);

-- Table: Owner
CREATE TABLE owners (
    owner_id INT AUTO_INCREMENT PRIMARY KEY,
    owner_name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NOT NULL
);

-- Table: Farmer
CREATE TABLE farmers (
    farmer_id INT AUTO_INCREMENT PRIMARY KEY,
    farmer_name VARCHAR(255) NOT NULL,
    farmer_kata_number VARCHAR(255) NOT NULL,
    owner_id INT NOT NULL,
    farmer_phone_number VARCHAR(20) NOT NULL,
    FOREIGN KEY (owner_id) REFERENCES owners(owner_id)
);

-- Table: Land
CREATE TABLE lands (
    land_id INT AUTO_INCREMENT PRIMARY KEY,
    land_name VARCHAR(255) NOT NULL,
    land_kanal INT NOT NULL,
    land_crop VARCHAR(255) NOT NULL,
    land_keta_number VARCHAR(255) NOT NULL,
    owner_id INT NOT NULL,
    farmer_id INT NOT NULL,
    FOREIGN KEY (owner_id) REFERENCES owners(owner_id),
    FOREIGN KEY (farmer_id) REFERENCES farmers(farmer_id)
);
