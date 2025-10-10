<?php

$tableBody = "";
foreach ($bands as $band) {
    $image = '<img class="bandImg" src= "data:image/png;base64, ' . base64_encode($band->bandImage) . '" alt="' . $band->name . '" >';
    $tableBody .= <<<HTML
            <tr>
                <td>{$band->id}</td>
                <td>{$band->name}</td>
                <td>{$image}</td>
                <td class='flex float-right'>
                    <form method='post' action='/bands/edit'>
                        <input type='hidden' name='id' value='{$band->id}'>
                        <button type='submit' name='btn-edit' title='Módosít'><i class='fa fa-edit'></i></button>
                    </form>
                    <form method='post' action='/bands'>
                        <input type='hidden' name='id' value='{$band->id}'>    
                        <input type='hidden' name='_method' value='DELETE'>
                        <button type='submit' name='btn-del' title='Töröl'><i class='fa fa-trash trash'></i></button>
                    </form>
                </td>
            </tr>
            HTML;
}

$html = <<<HTML
        <table id='admin-subjects-table' class='admin-subjects-table'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Együttes</th>
                    <th>Együttes fotó</th>
                    <th>
                        <form method='post' action='/bands/create'>
                            <button type="submit" name='btn-plus' title='Új'>
                                <i class='fa fa-plus plus'></i>&nbsp;Új</button>
                        </form>
                    </th>
                </tr>
            </thead>
             <tbody>%s</tbody>
            <tfoot>
            </tfoot>
        </table>
        HTML;

echo sprintf($html, $tableBody);
