<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/stylesCR.css">
    <link rel="stylesheet" href="./css/search.css"> <!-- Enlaza el archivo search.css -->
    <title>Cursos. ⏱️</title>
</head>
<body>
    <header>
        <div class="imagen">
            <img src="./img/gradu.png" alt="logoDelProyecto">
            <h2 class="nombre-pagina">MindVerse</h2>
        </div>
        <nav>
            <a href="./index.html" type="_blank" class="links">Inicio</a>
        </nav>
    </header>

    <h1 class="titulo">¡Elige tu curso y navega dentro de estos¡</h1>

    <!-- Barra de búsqueda -->
    <div class="buscar">
        <input type="text" placeholder="Buscar" id="searchInput" required />
        <div class="btn">
            <i class="fas fa-search icon"></i>
        </div>
    </div>
    
    <div class="contenedor">
        <div class="curso">
            <img src="./img/once.png">
            <h4>11-00</h4>
            <p></p>
            <a href="./listado.php">!Listado¡</a>
        </div>

        <div class="curso">
            <img src="./img/diezz.png">
            <h4>10-00</h4>
            <p></p>
            <a href="./listado.php">!Listado¡</a>
        </div>

        <div class="curso">
            <img src="./img/nuevee.png">
            <h4>9-00</h4>
            <p></p>
            <a href="./listado.php">!Listado¡</a>
        </div>

        <div class="curso">
            <img src="./img/ocho.png">
            <h4>8-00</h4>
            <p></p>
            <a href="./listado.php">!Listado¡</a>
        </div>
    </div>

    <script>
        const searchBar = document.getElementById('searchInput');
        const cursos = document.querySelectorAll('.curso');

        searchBar.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            cursos.forEach(curso => {
                const cursoNombre = curso.querySelector('h4').innerText.toLowerCase();
                if (cursoNombre.includes(searchTerm)) {
                    curso.style.display = 'block';
                } else {
                    curso.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>