
<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href = "styles/css/Normalize.css">
    <link rel="stylesheet" href="styles/css/styles.css">

    <title>Multiplication table.</title>
</head>
<body class = 'preload'>

    <!-- =[ PRELOADER ]= -->
    <div id = "preloader"></div>
    <script>
        let preloader = document.getElementById('preloader');

        window.addEventListener('load', () => {
            setTimeout(() => {
                preloader.classList.add('hidden');
                document.body.className = 'loaded';
            }, 1000);
        });
    </script>

    
    <!-- [ NAVBAR ] -->
    <nav>
        <button class = 'ico menu'>
            <svg class="icon">
                <use xlink:href="imgs/icons.svg#ico-menu"></use>
            </svg>
        </button>

        <h1 class = 'logo'>Math test.</h1>

        <button class = 'ico enter'>
            <svg class="icon">
                <use xlink:href="imgs/icons.svg#ico-enter"></use>
            </svg>
            enter
        </button>
        
    </nav>


    <!-- [ MAIN ] -->
    <main>

        <!-- [ content ] -->
        <div class = 'content'>

           <form action = 'checkout.php' method = 'POST' class = 'form'>

                <div class="task">
                    <h3 class = 'task-title'>Sort type:</h3>
                    <span id = 'task-description'>
                        Selection sort
                    </span>
                    <h5 class="task-inputs-title">Inputs:</h5>
                    <p class = 'task-inputs'></p>
                </div>

                
                <label class = 'centered' for="task-select">Select sort type:</label>
                <select name="task-select" id="task-select" onchange="setSortType()" required>
                    <option value="0" selected>Selection sort</option>
                    <option value="1">Bubble sort</option>
                    <option value="2">Shell sort</option>
                    <option value="3">Gnome sort</option>
                    <option value="4">Quicksort</option>
                    <option value="5">In-built sort</option>
                </select>
                
                <input type="submit" class = 'submit-middle success' value = 'SORT' />

                <label for="full-name">Add element:</label>
                <input type="text" name = 'value' id = 'value' autocomplete = 'off' placeholder = 'enter value ...'>
                
                <a onclick = 'addValue()' class = 'button'>Add value</a>
                
                <!-- hidden field: keeps output array -->
                <input type="text" name = 'array' id = 'array' hidden />
            </form>



        </div>

    </main>

    <!-- [ FOOTER ] -->
    <footer>
        
    </footer>


    <script>

        const setSortType = () => {
            // [ select parts ]
            let select = document.getElementById('task-select');
            let select_description = document.getElementById('task-description');

            // [ task selected ]
            let sort_type = select.options[select.selectedIndex].text;


            // set > task
            select_description.innerHTML = sort_type;
        };

        let array = [];
        let string = '';
        const addValue = () => {
            let value = parseInt(document.getElementById('value').value);
            let inputs = document.querySelector('p.task-inputs');
            console.log(typeof(value));

            if(value !== '' &&  !isNaN(value) && typeof(value) == 'number' ) {
                array.push(value);
                string += string ? (' , ' + value) : value;
                inputs.innerHTML = '[ ' + string + ' ]';
                document.getElementById('value').value = '';
    
                document.getElementById('array').value = array;
            } else {
                alert('Проверьте корректность введенных данных');
            }

        };

    </script>

</body>
</html>
