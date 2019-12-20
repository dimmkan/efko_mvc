<?php session_start(); ?>
<html>
<head>
    <link href="/css/editLAStyle.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="/list/save" method="post">
    <input type="hidden" name="id" value="<?= (isset($data['id']) ? ($data['id']) : "") ?>">
    <ul>
        <li>
            <label for="description">Описание</label>
            <input type="text" name="descr" id="descr" placeholder="Описание" required autofocus
                   maxlength="250" value="<?= htmlspecialchars($data['descr']) ?>" <?= ($_SESSION['userData']['rules'] || $data['fixed'] ? " readonly" : "") ?>/>
        </li>
        <li>
            <label for="datebeg">Дата начала отпуска</label>
            <input type="date" name="datebeg" id="datebeg" placeholder="YYYY-MM-DD" required maxlength="10" value="<?= $data['datebeg'] ? date("Y-m-d", strtotime($data['datebeg'])) : "" ?>" <?= ($_SESSION['userData']['rules'] || $data['fixed'] ? " readonly" : "") ?>/>
        </li>
        <li>
            <label for="dateend">Дата окончания отпуска</label>
            <input type="date" name="dateend" id="dateend" placeholder="YYYY-MM-DD" required maxlength="10" value="<?= $data['dateend'] ? date("Y-m-d", strtotime($data['dateend'])) : "" ?>" <?= ($_SESSION['userData']['rules'] || $data['fixed'] ? " readonly" : "") ?>/>
        </li>

        <li>
            <?php if($_SESSION['userData']['rules']) {?> <label for="fixed">Зафиксирована</label> <?php }?>
            <input type="<?= (!$_SESSION['userData']['rules'] ? "hidden" : "checkbox") ?>" name="fixed" <?= ($data['fixed'] ? " checked" : "") ?> />
        </li>

    </ul>

    <div class="buttons">
        <input type="submit" name="save" value="Сохранить"/>
        <input type="submit" formnovalidate formaction="/list/cancel" value="Отмена"/>
    </div>

</form>

<?php if(!$data['fixed'] && !$_SESSION['userData']['rules'] && isset($data['id'])) { ?>
    <p><a href="/list/delete/<?= (isset($data['id']) ? ($data['id']) : "") ?>"
          onclick="return confirm('Удалить заявку?')">
            Удалить заявку
        </a>
    </p>
<?php } ?>
</body>
</html>
