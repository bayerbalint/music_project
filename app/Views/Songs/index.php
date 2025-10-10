<?php

$tableBody = "<div id='songsContainer'>";
foreach ($songs as $song) {
    $music = '<source src="data:video/mp3;base64, ' . base64_encode($song->song) . '" type="audio/mpeg">';
    $producer = $song->bandId == 0 ? $song->getArtist()->name : $song->getBand()->name;
    $album = $song->albumId == 0 ? "-" : $song->getAlbum()->name;

    $tableBody .= <<<HTML
            <div class="songContainer">
                <div><u>Előadó(k):</u> {$producer} <u>Album:</u> {$album}</div>
                <div><u>Cím:</u> {$song->title} <u>Műfaj:</u> {$song->genre}</div>
                <div><u>Nyelv:</u> {$song->language}</div>
                <div class="functionButtons">
                    <audio controls loop class="audio">
                        {$music}
                    </audio>
                    <div class='flex float-right'>
                        <form method='post' action='/edit'>
                            <input type='hidden' name='id' value='{$song->id}'>
                            <button type="submit" name="btn-edit"><i class='fa fa-edit'></i></button>
                        </form>
                        <form method='post' action='/'>
                            <input type='hidden' name='id' value='{$song->id}'>    
                            <input type='hidden' name='_method' value='DELETE'>
                            <button type='submit' name='btn-del' title='Töröl'><i class='fa fa-trash trash'></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </tr>
        HTML;
}
$tableBody .= "</div>";

$html = <<<HTML
        <form method='post' action='/createOptions'>
            <a class="aButton" href="/createOptions"><i class='fa fa-plus plus'></i>&nbsp;Új</a>
        </form>
        HTML;

echo $html;
echo $tableBody;
