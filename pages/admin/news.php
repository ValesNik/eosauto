<?php
$news = getNewsNoLimit($db);
if(isset($_GET['id']))
    $newsFromId = getNewsFromId($db,$_GET['id']);
?>

<div class="viewTables">
    <div>
        <table>
            <caption>Новости</caption>
            <tr>
                <td><p>Новость</p></td>
                <td></td>
            </tr>
            <? if(isset($news)): ?>
                <? while ($arr = $news->fetch_array()): ?>
                    <tr>
                        <td><a href="?loc=viewNews&id=<?=$arr['id']?>"><?= $arr['news']?></a></td>
                        <td>
                            <a href="/?loc=viewNews&delete=<?= $arr['id'] ?>">x</a>
                        </td>
                    </tr>
                <? endwhile; ?>
            <? else: ?>
            <? endif; ?>
            <tr>
                <form action="../../scripts/scripts.php" method="post">

                    <td><div class="block">
                            <div>
                                <p>Новость</p>
                                <textarea required  name="news"><?=$newsFromId['news']?></textarea>
                            </div>
                        </div>
                    </td>
                    <? if(isset($newsFromId)):?>
                        <input type="hidden" name="id" value="<?= $_GET['id']?>">
                        <input type="hidden" name="table" value="editNews">
                    <? else: ?>
                        <input type="hidden" name="table" value="addNews">
                    <? endif; ?>
                    <td><button class="button">Отправить</button></td>

                </form>
            </tr>
        </table>
    </div>
</div>