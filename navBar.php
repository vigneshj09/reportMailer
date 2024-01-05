<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
        }

        nav {
            background-color: #3498db;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color:#fff;
        }
        ul {
            display: flex;
            list-style-type: none;
            gap: 20px;
            font-size: larger;
            font-weight: bold;
            color: #fff;
            /* margin-top: 10px; */
        }

        a {
            color: #fff;
            text-decoration: none;
            padding: 15px;
        }

        a:hover {
            color: #000;
        }

        h1 {
            text-align: center;
            margin: 2%;
            margin-bottom: 1%;
        }

        .menu-icon {
            display: none;
            cursor: pointer;
            font-size: larger;
            color: #fff;
        }
        .current-page a{
            color: #000; 
        }
        .current-page{
            background-color: #fff;
            border-radius: 15px;
        }

        @media screen and (max-width: 768px) {
            .menu-icon {
                display: block;
            }

            ul {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 30px;
                left: 0;
                padding: 10px;
                width: 100%;
                background-color: #3498db;
            }

            ul.show {
                display: flex;
            }
            h1{
                font-size: 1rem;
                margin: 10%;
            }
        }
    </style>
</head>
<body>
    <nav>
       
        <div class="menu-icon" onclick="toggleMenu()">☰</div>
        <ul>
            <li <?php 
                    if(basename($_SERVER['PHP_SELF']) == 'index.php') 
                        echo 'class="current-page"'; ?>><a href="index.php">Entry</a></li>
            <li <?php 
                    if(basename($_SERVER['PHP_SELF']) == 'report.php') 
                        echo 'class="current-page"'; ?>><a href="report.php">Report</a></li>
        </ul>
    </nav>

    <script>
        function toggleMenu() {
            var ul = document.querySelector('ul');
            ul.classList.toggle('show');
        }
    </script>
</body>
</html>
