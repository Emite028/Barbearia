<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net" rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="stylesheet">
    
    <style>
        :root {
            --roxo-principal: #8e44ad;
            --roxo-escuro: #732d91;
            --fundo-site: #1a1a2e; 
        }

        body { 
            background-color: var(--fundo-site); 
            font-family: 'Poppins', sans-serif; 
            margin: 0;
            padding: 0;
        }

        /* Estilo do Header */
        .main-header {
            background-color: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(10px); 
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 30px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .logo {
            color: #fff;
            font-size: 24px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo span {
            color: var(--roxo-principal);
        }

        .nav-links a {
            color: #ccc;
            text-decoration: none;
            margin-left: 20px;
            font-size: 14px;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: var(--roxo-principal);
        }

        .todo-card { 
            max-width: 500px; 
            margin: 0 auto 50px auto; 
            background: #fff; 
            border-radius: 15px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.4); 
            overflow: hidden; 
        }
    </style>
</head>
<body>

<header class="main-header">
    <div class="header-content">
        <a href="index.php" class="logo">
            <span>✂️</span> Barber<span>Shop</span>
        </a>
        <nav class="nav-links">
            <a href="index.php">Início</a>
            <a href="#">Serviços</a>
            <a href="#">Minha Conta</a>
        </nav>
    </div>
</header>
