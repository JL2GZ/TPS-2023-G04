<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/stylesPR.css">
    <link rel="stylesheet" href="./css/search.css"> <!-- Enlaza el archivo search.css -->
    <title>Profesores. 🕰️</title>
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

    <h1 class="titulo">¡Elige tu materia y lee informacion acerca de ella!</h1>

    <!-- Barra de búsqueda -->
    <div class="buscar">
        <input type="text" placeholder="Buscar" id="searchInput" required />
        <div class="btn">
            <i class="fas fa-search icon"></i>
        </div>
    </div>
    
    <div class="contenedor">
        <div class="materia">
            <img src="./img/Quimico.png">
            <h4>Saul Zaragoza</h4>
            <p>
                Materia: Fisica 
            </p>
            <p>
                Edad: 38
            </p>
            <p>
                Cursos: 10 - 11
            </p>
            <p>
                Descripcion: Este es un profesional de la matematica estudiado en la universidad de los Andes. 
            </p>
            <a href="#">!Seguir leyendo¡</a>
        </div>

        <div class="materia">
            <img src="./img/Elif.png">
            <h4>Elif Damla</h4>
            <p>
                Materia: Quimica 
            </p>
            <p>
                Edad: 26
            </p>
            <p>
                Cursos: 9 - 11
            </p>
            <p>
                Descripcion: Esta es una de las profesionales de la quimica estudiada en la universidad de los Andes. 
            </p>
            <a href="#">!Seguir leyendo¡</a>
        </div>

        <div class="materia">
            <img src="./img/TheRock.png">
            <h4>Adan Rueda</h4>
            <p>
                Materia: Matematicas
            </p>
            <p>
                Edad: 30
            </p>
            <p>
                Cursos: 7 - 9
            </p>
            <p>
                Descripcion: Este es un profesional de la matematica estudiado en la universidad de los Andes. 
            </p>
            <a href="#">!Seguir leyendo¡</a>
        </div>

        <div class="materia">
            <img src="./img/peruano.png">
            <h4>Osuna Rueda</h4>
            <p>
                Materia: Tecnologia
            </p>
            <p>
                Edad: 34
            </p>
            <p>
                Cursos: 6 - 11
            </p>
            <p>
                Descripcion: Este es un profesional de la tecnologoia estudiado en la universidad de los Andes. 
            </p>
            <a href="#">!Seguir leyendo¡</a>
        </div>
    </div>

    <script>
        const searchBar = document.getElementById('searchInput');
        const profesores = document.querySelectorAll('.materia');

        searchBar.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            profesores.forEach(profesor => {
                const profesorNombre = profesor.querySelector('h4').innerText.toLowerCase();
                if (profesorNombre.includes(searchTerm)) {
                    profesor.style.display = 'block';
                } else {
                    profesor.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>