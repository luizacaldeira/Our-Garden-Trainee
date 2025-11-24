<?php 
    session_start();

    if(!isset($_SESSION['id'])){
        header('Location: /login');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/css/styles.css">
    <link rel="stylesheet" href="../../../public/css/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Yeseva+One&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="containerDashboard">
        <!-- <div class="sidebarDashboard"></div> -->
        <div class="mainDashbord">
            <div class="section1">
                <div class="total">
                    <p>Total de usuários: 42</p>
                    <p>Total de publicações: 102</p>
                </div>
                <div class="profileADM">
                    <i class="bi bi-person-circle"></i>
                    <div class="textADM">
                        <h5>Julia Rodrigues</h5>
                        <p>administrador</p>
                    </div>
                    <div class="arrow">
                        <i class="bi bi-chevron-down"></i>        
                    </div>
                </div>
            </div>
            <div class="section2">
                <h3>Dashboard</h3>
            </div>
            <div class="section3Total">
                <div class="section3">
                    <div class="icon">
                        <i class="bi bi-house-door-fill"></i>
                    </div>
                    <div class="containerUsuarios">
                        <div class="content">
                            <div class="title">
                                <h2>Home</h2>
                            </div>
                            <div class="text">
                                <p>Visualize as últimas novidades do Our Garden</p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="verMais">
                        <p>Ver mais</p>
                        <i class="bi bi-arrow-right"></i>
                    </div> -->
                </div>
                <div class="section3">
                    <div class="icon">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <div class="containerUsuarios">
                        <div class="content">
                            <div class="title">
                                <h2>Usuários</h2>
                            </div>
                            <div class="text">
                                <p>Visualize e administre os usuários do sistema</p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="verMais">
                        <p>Ver mais</p>
                        <i class="bi bi-arrow-right"></i>
                    </div> -->
                </div>
                <div class="section3">
                    <div class="icon">
                        <i class="bi bi-file-post"></i>
                    </div>
                    <div class="containerUsuarios">
                        <div class="content">
                            <div class="title">
                                <h2>Publicações</h2>
                            </div>
                            <div class="text">
                                <p>Gerencie e crie novas postagens para o blog</p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="verMais">
                        <p>Ver mais</p>
                        <i class="bi bi-arrow-right"></i>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>