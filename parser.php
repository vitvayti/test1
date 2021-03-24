<?
$delimiter = ';';

$csv = file_get_contents('bd.csv');
$rows = explode(PHP_EOL, $csv);

$arData = [];

foreach ($rows as $row)
{
    $arRow = explode($delimiter, $row);
    $arRow = [
        'date' => $arRow[0],
        'kbk' => $arRow[1],
        'address' => $arRow[2],
        'sum' => $arRow[3],
        'count' => 1
    ];
    if($arData[$arRow['kbk']]) {
        $arData[$arRow['kbk']]->sum += $arRow['sum'];
        $arData[$arRow['kbk']]->count += 1;
    }else{
        $arData[$arRow['kbk']] = (object)$arRow;
    }
}

?>
