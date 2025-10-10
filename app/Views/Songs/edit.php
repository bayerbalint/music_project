<?php

$artistOption = $song->artistId == null ? "" : '
    <label for="song">Előadó</label>
    <select name="artistId" id="artistId">' . 
        $song->getArtists($song->artistId) . 
    '</select><br>
'; 

$bandOption = $song->bandId == null ? "" : '
    <label for="song">Együttes</label>
    <select name="bandId" id="bandId">' . 
        $song->getBands($song->bandId) .
    '</select><br>
';

$hiddenInputs = $song->artistId == null ? '<input type="hidden" name="artistId" value="0">' : "";
$hiddenInputs .= $song->bandId == null ? '<input type="hidden" name="bandId" value="0">' : "";

$html = <<<HTML
    <form method='post' action='/' enctype="multipart/form-data">
        <input type='hidden' name='_method' value='PATCH'>
        <input type="hidden" name="id" value="{$song->id}">
        {$hiddenInputs}
        <fieldset>
            {$artistOption}
            <label for="song">Album</label>
            <select name="albumId" id="albumId">
                <option>-</option>
                {$song->getAlbums($song->albumId)}
            </select><br>
            {$bandOption}
            <label for="song">Zene</label>
            <input type="file" name="song" id="song"><br>
            <label for="song">Cím</label>
            <input type="text" name="title" id="title" value="{$song->title}"><br>
            <label for="song">Műfaj</label>
            <input type="text" name="genre" id="genre" value="{$song->genre}"><br>
            <label for="song">Nyelv</label>
            <input type="text" name="language" id="language" value="{$song->language}">
            <hr>
            <button type="submit" name="btn-update"><i class="fa fa-save">                    
                </i>&nbsp;Mentés
            </button>
            <a href="/"><i class="fa fa-cancel"></i>&nbsp;Mégse
            </a>
        </fieldset>
    </form>
HTML;

echo $html;