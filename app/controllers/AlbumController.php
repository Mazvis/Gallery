<?php

/**
 * Class AlbumController
 */
class AlbumController extends BaseController {

    /*
     * UPLOADING/ EDITING
     */

    /**
     * Uploads photo/photos to album
     *
     * @return mixed
     */
    public function uploadPhoto() {
        $currentAlbumId = Input::get('albumId');

        if(Auth::check()){
            $album = new Album();
            $albums = new Albums();
            $currentUserID = Auth::user()->id;
            if(Auth::user()->role_id == 1
                || $album->isUserAlbumCreator($currentUserID, $currentAlbumId)
                || $albums->isUserAlbumModerator($currentAlbumId, $currentUserID)
            ){
                $photoName = strip_tags(Input::get('photoName'));
                $shortDescription = strip_tags(Input::get('shDescription'));
                $placeTaken = strip_tags(Input::get('placeTaken'));
                $selectedCategories = Input::get('categories');
                $writtenTags = Input::get('tagsToAdd');
                $users = Input::get('users');

                $photoFiles = array();
                if (Input::hasFile('photos'))
                    $photoFiles = Input::file('photos');

                $titlePhoto = Input::get('titlePhoto');

                return $album->uploadPhoto($currentAlbumId, $currentUserID, $photoName, $shortDescription, $placeTaken, $selectedCategories, $writtenTags, $photoFiles, $titlePhoto, $users);
                //return Redirect::to('albums/'.$currentAlbumId);
            }
        }
        //return $this->getPhotos($currentAlbumId);
    }

    /**
     * Gets values from inputs ant edits album data
     *
     * @return mixed
     */
    public function editAlbum() {
        $currentAlbumId = Input::get('albumId');

        if(Auth::check()){
            $album = new Album();
            $albums = new Albums();
            $currentUserID = Auth::user()->id;
            if($album->isUserAlbumCreator($currentUserID, $currentAlbumId)
                || Auth::user()->role_id == 1
                || $albums->isUserAlbumModerator($currentAlbumId, $currentUserID)
            ){
                $albumName = strip_tags(Input::get('albumName'));
                $shortDescription = strip_tags(Input::get('shDescription'));
                $fullDescription = strip_tags(Input::get('fullDescription'));
                $placeTaken = strip_tags(Input::get('placeTaken'));

                $titlePhotoFile = null;
                if (Input::hasFile('albumTitlePhoto'))
                    $titlePhotoFile = Input::file('albumTitlePhoto');

                $moreModeratorsToAdd = Input::get('moreModeratorsToAdd');

                $moderatorsToDelete = Input::get('moderatorsToDelete');

                $album = new Album;
                return $album->editAlbum($currentAlbumId, $albumName, $shortDescription, $fullDescription, $placeTaken, $titlePhotoFile, $moreModeratorsToAdd, $moderatorsToDelete);
            }
        }
        return Redirect::to('albums/'.$currentAlbumId);
    }

    /*
     * GETS
     */

    /**
     * Gets all single album photos
     *
     * @param $albumId
     * @return mixed
     */
    public function getAlbumPhotos($albumId){
        $album = new Album();
        return $album->getAlbumPhotos($albumId);
    }

    /**
     * Gets single album data
     *
     * @param $albumId
     * @return mixed
     */
    public function getAlbumDataByAlbumId($albumId){
        $album = new Album();
        return $album->getAlbumDataByAlbumId($albumId);
    }

    /*
     * DELETES
     */

    /**
     * Deletes photo from album
     *
     * @return string message
     */
    public function deletePhoto(){

        if(Auth::check()){
            $currentUserID = Auth::user()->id;
            $photoId = strip_tags(Input::get('photoId'));
            $photo = new Photo();
            $albums = new Albums();
            if($photo->isUserPhotoCreator($currentUserID, $photoId)
                || Auth::user()->role_id == 1
                || $albums->isUserAlbumPhotoModerator($photoId, $currentUserID)
            ){
                $album = new Album();
                return $album->deletePhoto($photoId);
            }
        }
        return "not singned in or havent rules to delete";
    }

    /**
     * Deletes album in album page
     *
     * @return string
     */
    public function deleteAlbum(){

        if(Auth::check()){
            $currentUserID = Auth::user()->id;
            $albumId = strip_tags(Input::get('albumId'));
            $album = new Album();
            $albums = new Albums();
            if($album->isUserAlbumCreator($currentUserID, $albumId)
                || Auth::user()->role_id == 1
                || $albums->isUserAlbumModerator($albumId, $currentUserID)
            ){

                return $album->deleteAlbum($albumId);
            }
        }
        return "u have no rules";
    }

    /*
     * LIKES
     */
    /**
     * Gets album likes
     *
     * @param $albumId
     * @return mixed
     */
    public function getAlbumLikes($albumId){
        $album = new Album();
        return $album->getAlbumLikes($albumId);
    }

    /**
     * Checks if user is already liked current album
     *
     * @param $currentAlbumId
     * @return int|string
     */
    public function isLikeAlreadyExists($currentAlbumId){
        $album = new Album();
        if(Auth::check()){
            $currentUserID = Auth::user()->id;
            return $album->isLikeAlreadyExists($currentAlbumId, $currentUserID);
        }
        return "u not signed in";
    }

    /**
     * Makes like in album
     *
     * @return mixed
     */
    public function makeLike(){
        if(Auth::check())
            if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                return $this->makeALike();
    }

    /**
     * Makes like
     *
     * @return mixed
     */
    public function makeALike(){
        $album = new Album();
        $currentAlbumId = Input::get('albumId');
        if(Auth::check()){
            $currentUserID = Auth::user()->id;
            return $album->makeLike($currentAlbumId, $currentUserID);
        }
    }

    /*
     * COMMENTS
     */

    /**
     * Gets all album comments
     *
     * @param $albumId
     * @return mixed
     */
    public function getAlbumComments($albumId){
        $album = new Album();
        return $album->getAlbumComments($albumId);
    }

    /**
     * Writes comment
     *
     * @return mixed
     */
    public function writeComment(){
        $album = new Album();

        $currentUserID = null; //default
        if(Auth::check())
            $currentUserID = Auth::user()->id;

        $currentAlbumId = strip_tags(Input::get('albumId'));
        $comment = strip_tags(Input::get('comment'));
        $posterIp = Request::getClientIp();

        return $album->writeComment($comment, $currentAlbumId, $currentUserID, $posterIp);
    }

    /**
     * Deletes selected comment in album or photo page
     *
     * @return string
     */
    public function deleteComment(){
        if(Auth::check()){
            $commentId = strip_tags(Input::get('commentIdToDelete'));
            $album = new Album();
            return $album->deleteComment($commentId);
        }
    }

    /*
     * VIEWS
     */

    /**
     * Counts album views
     *
     * @param $albumId
     */
    public function countViews($albumId){
        $album = new Album();
        return $album->countViews($albumId);
    }

    /*
     * USER
     */

    /**
     * Gets all chosen user albums
     *
     * @param $userId
     * @return mixed
     */
    public function getAllUserAlbums($userId){
        $album = new Album;
        return $album->getAllUserAlbums($userId);
    }

    /**
     * Checks if user is album creator
     *
     * @param $albumId
     * @return int
     */
    public function isUserAlbumCreator($albumId){
        $album = new Album;
        $currentUserId = 0;
        if(auth::check())
            $currentUserId = Auth::user()->id;
        return $album->isUserAlbumCreator($currentUserId, $albumId);
    }

    /**
     * Checks if user having privileges
     *
     * @param $albumId
     * @return int
     */
    public function isUserHavingPrivilegies($albumId){
        $album = new Album;

        if(Auth::check()){
            $userId = Auth::user()->id;
            if($album->isUserAlbumCreator(Auth::user()->id, $albumId) || Auth::user()->role_id == 1)
                return 1;
        }
        return 0;
    }

    /*
     * SIDEBAR CONTENT
     */

    /**
     * Gets five recent created albums
     *
     * @return mixed
     */
    public function recentAlbums(){
        $album = new Album();
        return $album->recentAlbums();
    }
}