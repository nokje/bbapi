// sql to create table
$sql = "CREATE TABLE products (
  obj_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  manufacturer VARCHAR(15),
  id VARCHAR(10),
  sku VARCHAR(30),
  ean13 VARCHAR(20),
  weight VARCHAR(5),
  height VARCHAR(5),
  width VARCHAR(5),
  depth VARCHAR(5),
  dateUpd VARCHAR(20),
  category VARCHAR(5),
  categories VARCHAR(5),
  dateUpdDescription VARCHAR(5),
  dateUpdImages VARCHAR(5),
  dateUpdStock VARCHAR(20),
  wholesalePrice VARCHAR(5),
  retailPrice VARCHAR(5),
  dateAdd VARCHAR(20),
  video VARCHAR(5),
  active VARCHAR(5),
  images VARCHAR(5),
  attributes VARCHAR(5),
  tags VARCHAR(5),
  taxRate VARCHAR(5),
  taxId VARCHAR(5),
  dateUpdProperties VARCHAR(20),
  dateUpdCategories VARCHAR(20),
  inShopsPrice VARCHAR(5),
  reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table products created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close()
