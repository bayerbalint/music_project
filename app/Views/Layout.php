<?php

namespace App\Views;

class Layout{
    public static function header($title = "Songs"){
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="hu">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>$title</title>

            <link rel="stylesheet" href="/css/songs.css" type="text/css">
            <link rel="stylesheet" href="/fontawesome/css/all.css" type="text/css">
        </head>
        <body>        
        HTML;
        self::navbar();
        self::handleMessages();
        echo '<div class="container">';
    }

    private static function handleMessages(){
        $messages = [
            'succes_message' => 'succes',
            'warning_message' => 'warning',
            'error_message' => 'error',
        ];

        foreach ($messages as $key => $type){
            if (isset($_SESSION[$key])){
                Display::message($_SESSION[$key], $type);
                unset($_SESSION[$key]);
            }
        }
    }

    private static function navbar(){
        echo <<<HTML
        <nav class="navbar">
            <ul class="nav-list">
                <li class="nav-button"><a href="/songs" title="Zenék"><button>Zenék</button></a></li>
                <li class="nav-button"><a href="/artists" title="Előadók"><button>Előadók</button></a></li>
                <li class="nav-button"><a href="/albums" title="Albumok"><button>Albumok</button></a></li>
            </ul>
        </nav>
        HTML;
    }

    public static function footer() {
        echo <<<HTML
        </div>
            <footer> 
                <hr>
                <p>2025 &copy; Bayer Bálint</p>
            </footer>
        </body>
        </html>
        HTML;
    }
}