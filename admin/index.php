<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/tools/db_process.php');

$query = "SELECT * FROM feedback";
$dbResult = mysqli_query($link, $query);

$arResult = [];


/* извлечение ассоциативного массива */
while ($row = mysqli_fetch_assoc($dbResult)) 
{
    $arResult[$row['id']] = $row;
}
mysqli_close($link);

?>


<?foreach($arResult as $key => $value):?>
<div>ID: <?=$value['id']?></div>
<div>Имя: <?=$value['name']?></div>
<div>Email: <?=$value['email']?></div>
<br>
<?endforeach;?>




