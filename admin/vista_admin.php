<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Manejo de archivo de imagen
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verifica si el archivo es una imagen real
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo json_encode(['message' => 'File is not an image.']);
        $uploadOk = 0;
    }

    // Verifica si el archivo ya existe
    if (file_exists($targetFile)) {
        echo json_encode(['message' => 'Sorry, file already exists.']);
        $uploadOk = 0;
    }

    // Limita el tamaño del archivo
    if ($_FILES["image"]["size"] > 500000) {
        echo json_encode(['message' => 'Sorry, your file is too large.']);
        $uploadOk = 0;
    }

    // Solo permite ciertos formatos de archivo
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo json_encode(['message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.']);
        $uploadOk = 0;
    }

    // Verifica si $uploadOk es 0 debido a un error
    if ($uploadOk == 0) {
        echo json_encode(['message' => 'Sorry, your file was not uploaded.']);
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Aquí puedes insertar los detalles del producto en la base de datos
            // Ejemplo:
            // $conn = new mysqli($servername, $username, $password, $dbname);
            // $stmt = $conn->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
            // $stmt->bind_param("ssss", $name, $price, $description, $targetFile);
            // $stmt->execute();

            echo json_encode(['message' => 'The file '. htmlspecialchars(basename($_FILES["image"]["name"])). ' has been uploaded.']);
        } else {
            echo json_encode(['message' => 'Sorry, there was an error uploading your file.']);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Product Upload</title>
    <style>
        /* Puedes agregar tus estilos aquí */
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="file"] {
            margin-bottom: 10px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <form id="product-form">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required>
        
        <button type="submit">Upload Product</button>
    </form>

    <script>
        document.getElementById('product-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('upload_product.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                // Optionally, you could clear the form here
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to upload product.');
            });
        });
    </script>
</body>
</html>