<html>
<head>
    <link href="/css/la_style.css" rel="stylesheet" type="text/css">
</head>
<body>


<table border="0" cellpadding="0" cellspacing="0" class="tbl1" width="800">
    <tr>
        <td colspan="4"></td>
    </tr>
    <tr valign="top">
        <td width="60%" height="91"><img src="/images/single_pixel.gif" width="1" height="140"></td>
        <td width="40%" height="91" colspan="3" valign="top" align="center">

        </td>
    </tr>
    <tr>
        <td colspan="3"  >
    <tr>
        <td valign="top" colspan="4">
            <table width="200%" border="0" cellspacing="25">
                <tr>
                    <td width="8%" valign="top"><img src="/images/single_pixel.gif" width="140" height="1"><br>
                        <p>Меню<br>
                            <a  class="menu" href="/list">К списку</a><br>
                            <?php if(!$_SESSION['userData']['rules']) {?>
                                <a  class="menu" href="/list/new">Новая заявка</a><br>
                            <?php }?>
                            <a  class="menu" href="/list/logout">Выйти</a> </p>
                    </td>
                    <td align="left" width="92%">
                        <table class="table">
                            <?php if (isset($data['errorMessage'] ) ) { ?>
                                <tr class="tr"> <div class="errorMessage"><?php echo $data['errorMessage'] ?></div> </tr>
                            <?php } ?>
                            <?php if ( isset($data['statusMessage'] ) ) { ?>
                                <tr class="tr"> <div class="statusMessage"><?php echo $data['statusMessage'] ?></div> </tr>
                            <?php } ?>
                            <tr class="tr">
                                <th class="th">Номер заявки</th>
                                <th class="th">ФИО Сотрудника</th>
                                <th class="th">Начало отпуска</th>
                                <th class="th">Конец отпуска</th>
                                <th class="th">Описание</th>
                                <th class="th">Согласовано</th>
                                <th class="th"></th>
                            </tr>
                            <?php foreach ($data['listApps'] as $leaveApp ) { ?>
                                <tr class="tr" <?php if($leaveApp['userid'] == $_SESSION['userData']['id'] || $_SESSION['userData']['rules'] == "1"){
                                    echo "onclick=\"location='/list/edit/{$leaveApp['id']}'\"";
                                }?>>
                                    <td class="td"><?= ($leaveApp['id']);?></td>
                                    <td class="td"><?= ($leaveApp['desc']);?></td>
                                    <td class="td"><?= date('j M Y', strtotime($leaveApp['datebeg']));?></td>
                                    <td class="td"><?= date('j M Y', strtotime($leaveApp['dateend']));?></td>
                                    <td class="td"><?= ($leaveApp['descr']);?></td>
                                    <td class="td"><?= ((int)$leaveApp['fixed']) ? "&#10004" : "&#10008";?></td>
                                    <td class="td"><a href="/list/edit/<?= $leaveApp['id'] ?>">Изменить</a></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
            </table>
            <h2>&nbsp;</h2>
        </td>
    </tr>
</table>
<!-- Do not remove this div -->
<div align="center"><p>
        <a href="http://www.logodesignweb.com/">Logo design web</a>
        | <a href="http://www.logodesignweb.com/webhostingguide/">Web hosting guide</a>
        | <a href="http://www.logodesignweb.com/stockphoto/">Public domain stock photos</a>
    </p>
    <br>
</div>
<!-- End of footer div -->

</body>
</html>