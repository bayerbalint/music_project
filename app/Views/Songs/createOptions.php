<?php

echo <<<HTML
        <form method='post' action='/createOptions' enctype="multipart/form-data">
            <fieldset>
                <label for="song">Válassz egy opciót</label>
                <a class="aButton" href="/createSongByArtist">Zenész</a>
                <a class="aButton" href="/createSongByBand">Zenekar</a>
                <hr>
                <a class="aButton" href="/"><i class="fa fa-cancel">                    
                    </i>&nbsp;Mégse
                </a>
            </fieldset>
        </form>
    HTML;