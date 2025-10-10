<?php

namespace App\Controllers;

use App\Models\SongModel;
use App\Views\Display;
use App\Models\AlbumModel;
use App\Models\ArtistModel;

class SongController extends Controller{
    public function __construct(){
        $song = new SongModel();
        parent::__construct($song);
    }

    public function index(){
        $song = $this->model->all(['order_by' => ['title'], 'direction' => ['ASC']]);
        $this->render('songs/index', ['songs' => $song]);
    }

    public function create(){
        $this->render('songs/createOptions');
    }

    public function createSongByArtist(){
        $this->render('songs/createSongByArtist');
    }

    public function createSongByBand(){
        $this->render('songs/createSongByBand');
    }

    public function edit($id){
        $song = $this->model->find($id);
        if (!$song){
            $_SESSION['warning_message'] = "A zene a megadott azonosítóval: $id nem található";
            $this->redirect('/');
        }
        $this->render('songs/edit', ['song' => $song]);
    }

    public function save($data){
        if (empty($data['title']) || empty($data['genre']) || empty($data['language'])){
            $_SESSION['warning_message'] = "Hiányos adatok";
            $this->redirect('/');
        }

        // check for the datatype of the given information (title can be numeric)
        if (is_numeric($data['genre']) || is_numeric($data['language'])){
            $_SESSION['warning_message'] = "Nem megfelelő adatatok";
            $this->redirect('/');
        }

        $songs = $this->model->all();
        foreach ($songs as $song){
            if ($song->title == $data['title']){
                $_SESSION['warning_message'] = "A megadott zene címe már szerepel!";
                $this->redirect('/');
            }
        }

        $this->model->artistId = (int)$data['artistId'];
        $this->model->albumId = (int)$data['albumId'];
        $this->model->bandId = (int)$data['bandId'];

        // handle file upload
        $fileName = "../files/" . $_FILES['song']['name'];
        if (move_uploaded_file($_FILES['song']['tmp_name'], $fileName)){
            $newFileName = str_replace(' ', '_', str_replace('\\', '/', $fileName));
            rename(realpath($fileName), $newFileName);
            $this->model->song = "LOAD_FILE('" . str_replace('\\', '/', realpath($newFileName)) . "')";
        }

        $this->model->title = $data['title'];
        $this->model->genre = $data['genre'];
        $this->model->language = $data['language'];
        $this->model->create();
        $this->redirect('/');
    }

    public function update($id, $data){
        $song = $this->model->find($id);
        if (!$song || empty($data['title']) || empty($data['genre']) || empty($data['language'])){
            $_SESSION['warning_message'] = "Hiányos adatok";
            $this->redirect('/');
        }

        // check for the datatype of the given information (title can be numeric)
        if (is_numeric($data['genre']) || is_numeric($data['language'])){
            $_SESSION['warning_message'] = "Nem megfelelő adatok";
            $this->redirect('/');
        }

        $songs = $this->model->all();
        foreach ($songs as $currsong){
            if ($id != $currsong->id && $currsong->title == $data['title']){
                $_SESSION['warning_message'] = "A megadott zene címe már szerepel!";
                $this->redirect('/');
            }
        }

        $song->artistId = (int)$data['artistId'];
        $song->albumId = (int)$data['albumId'];
        $song->bandId = (int)$data['bandId'];

        // handle file upload
        $fileName = "../files/" . $_FILES['song']['name'];
        if (move_uploaded_file($_FILES['song']['tmp_name'], $fileName)){
            $newFileName = str_replace(' ', '_', str_replace('\\', '/', $fileName));
            rename(realpath($fileName), $newFileName);
            $song->song = "LOAD_FILE('" . str_replace('\\', '/', realpath($newFileName)) . "')";
        }

        $song->title = $data['title'];
        $song->genre = $data['genre'];
        $song->language = $data['language'];
        $song->update();
        $this->redirect('/');
    }

    function show(int $id): void
    {
        $song = $this->model->find($id);
        if (!$song) {
            $_SESSION['warning_message'] = "Az előadó a megadott azonosítóval: $id nem található.";
            $this->redirect('/'); // Handle invalid ID
        }
        $this->render('songs/show', ['song' => $song]);
    }

    function delete(int $id): void
    {
        $song = $this->model->find($id);
        if ($song) {
            $result = $song->delete();
            if ($result) {
                $_SESSION['success_message'] = 'Sikeresen törölve';
            }
        }

        $this->redirect('/'); // Redirect regardless of success
    }
}