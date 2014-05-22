<?php

/**
 * Class AlbumsController
 */
class AlbumsController extends BaseController {

    /**
     * Creates album and redirects page
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAlbum() {

        if(Auth::check()){
            if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
                $currentUserId = Auth::user()->id;
                $albumName = strip_tags(Input::get('name'));
                $shortDescription = strip_tags(Input::get('shDescription'));
                $fullDescription = strip_tags(Input::get('description'));
                $placeTaken = strip_tags(Input::get('place'));
                //$selectedCategories = Input::get('categories');
                $selectedCategories = 'Uncategorized';

                $moderators = [];
                $moderators = Input::get('albumModerators');

                $albums = new Albums();
                return $albums->createAlbum($currentUserId, $albumName, $shortDescription, $fullDescription, $placeTaken, $selectedCategories, $moderators);
            }
        }
        return Redirect::back();
    }

    /**
     * Returs all albums array and show in albums page
     *
     * @return mixed
     */
    public function getAllAlbums(){
        $albums = new Albums();
        return $albums->getAllAlbums();
    }

    /**
     * @return null
     */
    public function isAlbumCreator(){
        if(Auth::check()){
            $albumM = new Album();
            $albums = $this->getAllAlbums();
            $i = 0;
            $array = null;
            foreach($albums as $album){
                if($albumM->isUserAlbumCreator(Auth::user()->id, $album->album_id) || Auth::user()->role_id == 1){
                    $array[$i] = 1;
                }
                else
                    $array[$i] = 0;
                $i++;
            }
            return $array;
        }
    }


    /**
     * MODERATORS
     */

    /**
     * @param $currentUserId
     * @return array
     */
    public function getAllOthersUsers($currentUserId) {
        $albums = new Albums();
        return $albums->getAllOthersUsers($currentUserId);
    }

    /**
     * @param $albumId
     * @return mixed
     */
    public function getAllAlbumModerators($albumId) {
        $albums = new Albums();
        return $albums->getAllAlbumModerators($albumId);
    }

    public function showAllLeftUsers($currentUserId, $albumId) {
        $all = $this->getAllOthersUsers($currentUserId);
        $mods = $this->getAllAlbumModerators($albumId);

        foreach($all as $id => $user) {
            foreach($mods as $modId=> $mod) {
                if ($id == $modId) {
                    unset($all[$id]);
                    unset($all[$id]);
                }
            }
        }

        return $all;
    }

    public function isUserAlbumModerator($albumId, $userId){
        $albums = new Albums();
        return $albums->isUserAlbumModerator($albumId, $userId);
    }


}