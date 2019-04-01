<?php require APPROOT . '/views/layout/header.php'; ?>
<?php
    $formSave   = 'message/save';
    $formUpdate = 'message/update';
    $formAction = $formSave;

    if(isset($message)) {
        $formAction = $formUpdate . '/' . $message->id;
        $actioNamed = 'Atualizar';
    } else {
        $message = new stdClass();
        $message->id   = '';
        $message->type = '';
        $message->text = '';
    }

?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="display-4 text-center">MVC CRUD Mensagem</h1>
            <form action="<?= URLROOT . '/' . $formAction ?>" method="POST">
                <div class="form-group">
                    <label for="type">Tipo</label>
                    <select required class="form-control" name="type" id="type">
                        <option value=""></option>
                        <option <?= ($message->type == 'INFO') ? 'selected': ''; ?> value="INFO">INFO</option>
                        <option <?= ($message->type == 'WARNING') ? 'selected': ''; ?> value="WARNING">WARNING</option>
                        <option <?= ($message->type == 'DANGER') ? 'selected': ''; ?> value="DANGER">DANGER</option>
                        <option <?= ($message->type == 'SUCCESS') ? 'selected': ''; ?> value="SUCCESS">SUCCESS</option>
                    </select>
                </div>
                <div class="form-group">
                    <div>
                        <label for="text">Mensagem</label>
                        <textarea required class="form-control"   name="text"><?= $message->text; ?></textarea>
                    </div>
                </div>
                <input class="btn btn-block btn-success" type="submit" value="<?= isset($actioNamed) ? $actioNamed : 'Cadastrar'; ?>" />
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Tipo</td>
                        <td>Mensagem</td>
                        <td>Ação</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($messages) <= 0): ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">Não há registro.</td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach($messages as $msg) : ?>
                        <tr>
                            <td><?= $msg->id;   ?></td>
                            <td><?= $msg->type; ?></td>
                            <td><?= $msg->text; ?></td>
                            <td>
                                <a class="btn btn-sm btn-secondary"href="<?= URLROOT . "/message/edit/{$msg->id}" ?>">Editar</a>
                                <a class="btn btn-sm btn-danger btn-exclude"href="<?= URLROOT . "/message/delete/{$msg->id}" ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layout/footer.php'; ?>