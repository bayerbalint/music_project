<?php

use App\Models\ArtistModel;
$artist = new ArtistModel();

echo <<<HTML
        <form method='post' action='/artists' enctype="multipart/form-data">
            <fieldset>
                <label for="artist">Együttes</label>
                <select name="bandId" id="bandId">
                    <option value="">-</option>
                    {$artist->getBands()}
                </select><br>
                <label for="artist">Előadó</label>
                <input type="text" name="name" id="name"><br>
                <label for="artist">Születési év</label>
                <input type="number" name="born" id="born" min="1900" max="2020"><br>
                <label for="artist">Hangszer</label>
                <input type="text" name="instrument" id="instrument"><br>
                <label for="artist">Előadó fotó</label>
                <input type="file" name="artistImage" id="artistImage">
                <hr>
                <button type="submit" name="btn-save">
                    <i class="fa fa-save"></i>&nbsp;Mentés
                </button>
                <a href="/artists"><i class="fa fa-cancel">                    
                    </i>&nbsp;Mégse
                </a>
            </fieldset>
        </form>
    HTML;