<?

function sortObject( $array, $args = ['date' => 'asc','kbk' => 'asc'] ){
    usort( $array, function( $a, $b ) use ( $args ){
        $res = 0;

        $a = (object) $a;
        $b = (object) $b;

        foreach( $args as $k => $v ){
            if($k == 'date'){
                $aValue = strtotime($a->$k);
                $bValue = strtotime($b->$k);
            }else{
                $aValue = $a->$k;
                $bValue = $b->$k;
            }
            if( $aValue == $bValue ) continue;

            $res = ( $aValue < $bValue ) ? -1 : 1;
            if( $v=='desc' ) $res= -$res;
            break;
        }

        return $res;
    } );

    return $array;
}

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

$arData = sortObject($arData);

?>

<table>
    <thead>
        <tr>
            <td>
                Дата
            </td>
            <td>
                КБК
            </td>
            <td>
                Адрес
            </td>
            <td>
                %%
            </td>
        </tr>
    </thead>
    <tbody>
        <?foreach ($arData as $element){?>
            <tr>
                <td>
                    <?=$element->date?>
                </td>
                <td>
                    <?=$element->kbk?>
                </td>
                <td>
                    <?=$element->address?>
                </td>
                <td>
                    <?if($element->count > 1){?>
                        <?=$element->sum/$element->count?>%
                        (<?=$element->count?>)
                    <?}else{?>
                        <?=$element->sum?>%
                    <?}?>
                </td>
            </tr>
        <?}?>
    </tbody>
</table>

<style>
    td{
        border: 1px solid;
        padding: 5px;
    }
</style>
