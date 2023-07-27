<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/stylesAC.css">
    <link rel="stylesheet" href="./css/search.css"> <!-- Enlaza el archivo search.css -->
    <title>Academico. ✨</title>
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

    <h1 class="titulo">¡Elige tu materia y lee información acerca de ella!</h1>

    <div class="buscar">
        <input type="text" placeholder="Buscar" id="searchInput" required />

        <div class="btn">
            <i class="fas fa-search icon"></i>
        </div>
    </div>

    <div class="contenedor">
        <div class="materia">
            <img src="./img/quimica2.png">
            <h4>Quimica</h4>
            <p>Facilitar conocimientos y desarrollar habilidades relacionadas con los principios y leyes que rigen la química, complementado el aprendizaje a través de la demostración experimental en laboratorio.</p>
            <a href="#">¡Seguir leyendo!</a>
        </div>

        <div class="materia">
            <img src="./img/fiisca2.png">
            <h4>Fisica</h4>
            <p>En la materia los/las estudiantes abordarán los conocimientos básicos y fundamentales vinculados con la mecánica clásica, tanto de partículas como de sistemas, la termodinámica y el estudio de los fenómenos ondulatorios.</p>
            <a href="#">¡Seguir leyendo!</a>
        </div>

        <div class="materia">
            <img src="./img/mate2.png">
            <h4>Matematicas</h4>
            <p>La Matemática contempla, entre sus objetivos generales, formar las bases del pensamiento lógico para resolver problemas y enfrentar situaciones de la vida cotidiana, integrando los conocimientos tecnológicos, humanísticos y científicos.</p>
            <a href="#">¡Seguir leyendo!</a>
        </div>

        <div class="materia">
            <img src="./img/tec2.png">
            <h4>Tecnologia</h4>
            <p>La asignatura de tecnología favorece el uso racional tanto de la tecnología como del desarrollo de conocimientos técnicos para la creación de todo tipo de proyectos.</p>
            <a href="#">¡Seguir leyendo!</a>
        </div>
    </div>

    <script>
        const searchBar = document.getElementById('searchInput');
        const materias = document.querySelectorAll('.materia');

        searchBar.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            materias.forEach(materia => {
                const materiaNombre = materia.querySelector('h4').innerText.toLowerCase();
                if (materiaNombre.includes(searchTerm)) {
                    materia.style.display = 'block';
                } else {
                    materia.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>