<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/stylesLT.css">
    <link rel="stylesheet" href="./css/search.css"> <!-- Enlaza el archivo search.css -->
    <title>Listados. 📜</title>
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

    <!-- Barra de búsqueda -->
    <div class="buscar">
        <input type="text" placeholder="Buscar" id="searchInput" required />
        <div class="btn">
            <i class="fas fa-search icon"></i>
        </div>
    </div>

    <main>
        <section class="informacion">
            <img src="./img/graduacionxd.png" class="imgInformacion">
            <h2 class="subtitulo1">INFORMACION DE CURSOS</h2>
            <p class="texto1">Aca podra buscar a su hijo(a) segun su curso y podra ver en las materias en las cuales esta llendo mal academicamente, recuerde que la lista sera actualizada cada trimestre entonces no se asuste por ver lo mismo por casi 3 meses</p>
        </section>
    </main>

    <hr style="width: auto;">

    <pre>
        Los estudiantes que estan en la parte de abajo son 
        los que obtuvieron un promedio menor a "3.0" que 
        es el minimo para pasar una asignatura.
    </pre>

    <details class="lista">
        <summary class="curso">11-00</summary>
        <p>Marcelo Harvey / Matematicas: 2.9</p>
        <p>Williams Reese / Quimica: 2.9</p>
        <p>Fredrick Cook / Sociales: 2.5</p>
        <p>Jonathan Stone / Etica: 2.8</p>
    </details>

    <details class="lista">
        <summary class="curso">10-00</summary>
        <p>Angelita Dillon / Religion: 1.9</p>
        <p>Julian Olson / Quimica: 2.0</p>
        <p>Burt Jefferson / Español: 2.5</p>
        <p>Marisa Cochran / Etica: 0.1</p>
    </details>

    <details class="lista">
        <summary class="curso">9-00</summary>
        <p>Tatiana Espinoza / Ingles: 1.9</p>
        <p>Valery Diaz / Sociales: 2.7</p>
        <p>Jose Martinez / Biologia: 2.6</p>
        <p>Vanessa Rodriguez / Artes: 2.9</p>
    </details>

    <details class="lista">
        <summary class="curso">8-00</summary>
        <p>Walter Martinez / ED. fisica: 2.3</p>
        <p>Roxanne Hall / Tecnologia: 2.8</p>
        <p>Francisco Rodriguez/ Biologia: 2.9</p>
        <p>Maria Bernal / Matematicas: 2.2</p> 
    </details>

    <script>
        const searchBar = document.getElementById('searchInput');
        const estudiantes = document.querySelectorAll('.lista');

        searchBar.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            estudiantes.forEach(estudiante => {
                const estudianteNombre = estudiante.querySelector('summary').innerText.toLowerCase();
                if (estudianteNombre.includes(searchTerm)) {
                    estudiante.style.display = 'block';
                } else {
                    estudiante.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>