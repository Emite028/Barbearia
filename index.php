<?php
$arquivo = 'agendamentos.json';
if (!file_exists($arquivo)) file_put_contents($arquivo, json_encode([]));
$agendamentos = json_decode(file_get_contents($arquivo), true) ?? [];

if (isset($_POST['add'])) {
    $data_formatada = $_POST['dia'] . " de " . $_POST['mes'];
    $agendamentos[] = [
        'id' => uniqid(),
        'info' => $_POST['cliente'] . " (" . $_POST['telefone'] . ") - " . $data_formatada . " às " . $_POST['horario']
    ];
    file_put_contents($arquivo, json_encode($agendamentos, JSON_PRETTY_PRINT));
    header("Location: index.php"); exit;
}

if (isset($_GET['del'])) {
    $id_remover = $_GET['del'];
    $agendamentos = array_filter($agendamentos, fn($item) => $item['id'] !== $id_remover);
    file_put_contents($arquivo, json_encode(array_values($agendamentos)));
    header("Location: index.php"); exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbearia - Agenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(135deg, #1a0a2e 0%, #000000 100%); 
            min-height: 100vh; 
            font-family: 'Segoe UI', sans-serif; 
            margin: 0; padding: 0; color: white;
            display: flex; flex-direction: column;
        }
        .main-wrapper { flex: 1; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .todo-card { width: 100%; max-width: 500px; background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); overflow: hidden; }
        .todo-header { padding: 20px; border-bottom: 1px solid #eee; text-align: center; font-weight: bold; color: #333; }
        .input-section { padding: 20px; }
        .custom-group { display: flex; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; margin-bottom: 10px; background: #fff; }
        .custom-group input, .custom-group select { border: none; padding: 10px; outline: none; flex: 1; font-size: 14px; color: #333; }
        .btn-add { background-color: #8e44ad; color: white; border: none; padding: 0 20px; font-size: 22px; cursor: pointer; }
        .todo-item { display: flex; align-items: center; padding: 12px; background: #f1f3f5; margin: 8px 15px; border-radius: 8px; }
        .todo-text { flex: 1; margin-left: 10px; color: #444; font-size: 14px; }
        .btn-delete { color: #ff4d4d; text-decoration: none; font-size: 18px; font-weight: bold; margin-left: 10px; }
        .label-hint { font-size: 10px; color: #999; text-transform: uppercase; margin-bottom: 3px; display: block; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="main-wrapper">
        <div class="todo-card shadow">
            <div class="todo-header"> Agendamentos </div>

            <div class="input-section">
                <form method="POST">
                    <div class="row g-2">
                        <div class="col-7">
                            <label class="label-hint">Cliente</label>
                            <div class="custom-group">
                                <input type="text" name="cliente" placeholder="Nome do cliente..." required>
                            </div>
                        </div>
                        <div class="col-5">
                            <label class="label-hint">Telefone</label>
                            <div class="custom-group">
                                <input type="tel" name="telefone" placeholder="(00) 00000-0000" required>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-4">
                            <label class="label-hint">Dia</label>
                            <div class="custom-group">
                                <select name="dia">
                                    <?php for($i=1; $i<=31; $i++) echo "<option value='$i'>$i</option>"; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="label-hint">Mês</label>
                            <div class="custom-group">
                                <select name="mes">
                                    <option value="Jan">Jan</option><option value="Fev">Fev</option>
                                    <option value="Mar">Mar</option><option value="Abr">Abr</option>
                                    <option value="Mai">Mai</option><option value="Jun">Jun</option>
                                    <option value="Jul">Jul</option><option value="Ago">Ago</option>
                                    <option value="Set">Set</option><option value="Out">Out</option>
                                    <option value="Nov">Nov</option><option value="Dez">Dez</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="label-hint">Hora</label>
                            <div class="custom-group">
                                <select name="horario">
                                    <option value="09:00">09:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="17:00">17:00</option>
                                </select>
                                <button type="submit" name="add" class="btn-add">+</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="pb-3">
                <?php if(empty($agendamentos)): ?>
                    <p class="text-center text-muted py-3 small">Nenhuma tarefa pendente.</p>
                <?php else: ?>
                    <?php foreach ($agendamentos as $ag): ?>
                    <div class="todo-item shadow-sm">
                        <input type="checkbox" class="form-check-input border-primary">
                        <span class="todo-text"><?= htmlspecialchars($ag['info']) ?></span>
                        <a href="?del=<?= $ag['id'] ?>" class="btn-delete" title="Apagar" onclick="return confirm('Deseja excluir?')">🗑</a>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>
