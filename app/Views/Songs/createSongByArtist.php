<?php

use App\Models\SongModel;
$song = new SongModel();

echo <<<HTML
        <form method='post' action='/' enctype="multipart/form-data">
            <input type='hidden' name='_method' value='POST'>
            <input type='hidden' name='bandId' value='0'>
            <fieldset>
                <label for="song">Előadó</label>
                <select name="artistId" id="artistId">
                    {$song->getArtists()}
                </select><br>
                <label for="song">Album</label>
                <select name="albumId" id="albumId">
                    <option value="0">-</option>
                    {$song->getAlbums()}
                </select><br>
                <label for="song">Zene</label>
                <input type="file" name="song" id="song"><br>
                <label for="song">Cím</label>
                <input type="text" name="title" id="title"><br>
                <label for="song">Műfaj</label>
                <input type="text" name="genre" id="genre"><br>
                <label for="song">Nyelv</label>
                <input type="text" name="language" id="language">
                <hr>
                <button type="submit" name="btn-save">
                    <i class="fa fa-save"></i>&nbsp;Mentés
                </button>
                <a class="aButton" href="/createOptions"><i class="fa fa-cancel"></i>&nbsp;Mégse
                </a>
            </fieldset>
        </form>
    HTML;