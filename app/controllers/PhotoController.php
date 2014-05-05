<?php

/**
 * Class PhotoController
 */
class PhotoController extends BaseController {

/*
 * EDIT
 */

    /**
     * Edits photo information
     *
     * @return string
     */
    public function editPhoto() {

        if(Auth::check()){
            $photo = new Photo();
            $currentUserID = Auth::user()->id;
            $currentPhotoId = strip_tags(Input::get('photoId'));
            if($photo->isUserPhotoCreator($currentUserID, $currentPhotoId) || Auth::user()->role_id == 1){

                $currentAlbumId = strip_tags(Input::get('albumId'));
                $selectedCategories = Input::get('categories');
                $editedTags = Input::get('photoTags');

                $photoName = strip_tags(Input::get('photoName'));
                $shortDescription = strip_tags(Input::get('shDescription'));
                $placeTaken = strip_tags(Input::get('placeTaken'));
                $albumTitlePhoto = Input::get('albumTitlePhoto');

                $photo = new Photo;
                return $photo->editPhoto($currentAlbumId, $currentPhotoId, $currentUserID, $photoName, $shortDescription, $placeTaken, $selectedCategories, $editedTags, $albumTitlePhoto);
            }
        }
    }

/*
 * GETS
 */

    /**
     * Returns single photo data
     *
     * @param $photoId
     * @param $albumId
     * @return mixed
     */
    public function getPhotoDataByPhotoId($photoId, $albumId){
        $photo = new Photo();
        return $photo->getPhotoDataByPhotoId($photoId, $albumId);
    }

    /**
     * Returns all photos with photos data
     *
     * @return mixed
     */
    public function getAllPhotoData(){
        $photo = new Photo;
        return $photo->getAllPhotoData();
    }

/*
 * DELETES
 */

    /**
     * Deltes photo from photo page
     *
     * @return mixed
     */
    public function deletePhoto(){
        $currentAlbumId = Input::get('albumId');

        if(Auth::check()){
            $photo = new Photo();
            $currentUserID = Auth::user()->id;
            $currentPhotoId = strip_tags(Input::get('photoId'));
            if($photo->isUserPhotoCreator($currentUserID, $currentPhotoId) || Auth::user()->role_id == 1){
                return $photo->deletePhoto($currentPhotoId);
                //return Redirect::to('albums/'.$currentAlbumId);
            }
        }
        //return $currentAlbumId;
    }

/*
 * LIKES
 */

    /**
     * Gets all photo likes(likers)
     *
     * @param $albumId
     * @return mixed
     */
    public function getPhotoLikes($albumId){
        $photo = new Photo();
        return $photo->getPhotoLikes($albumId);
    }

    /**
     * Checks if photo is already liked
     *
     * @param $currentPhotoId
     * @return int|string
     */
    public function isLikeAlreadyExists($currentPhotoId){
        $photo = new Photo();
        if(Auth::check()){
            $currentUserID = Auth::user()->id;
            return $photo->isLikeAlreadyExists($currentPhotoId, $currentUserID);
        }
        return "u not signed in";
    }

    /**
     * Makes photo like
     *
     * @return mixed
     */
    public function makeLike(){
        if(Auth::check())
            if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                return $this->makeALike();
    }

    /**
     * makes like
     *
     * @return mixed
     */
    public function makeALike(){
        $photo = new Photo();
        $currentPhotoId = strip_tags(Input::get('photoId'));
        if(Auth::check()){
            $currentUserID = Auth::user()->id;
            return $photo->makeLike($currentPhotoId, $currentUserID);
        }
    }

/*
 * COMMENTS
 */

    /**
     * Get all photo comments
     *
     * @param $photoId
     * @return mixed
     */
    public function getPhotoComments($photoId){
        $photo = new Photo();
        return $photo->getPhotoComments($photoId);
    }

    /**
     * Writes comment
     *
     * @return mixed
     */
    public function writeComment(){
        $photo = new Photo();

        $currentUserID = null;
        if(Auth::check())
            $currentUserID = Auth::user()->id;

        $currentPhotoId = strip_tags(Input::get('photoId'));
        $comment = strip_tags(Input::get('comment'));
        $posterIp = Request::getClientIp();

        return $photo->writeComment($comment, $currentPhotoId, $currentUserID, $posterIp);
    }

/*
 * TAGS
 */

    /**
     * Gets photo tags(for editing)
     *
     * @param $photoId
     * @return string
     */
    public function getPhotoTagsRow($photoId){
        $photo = new Photo;
        return $photo->getPhotoTagsRow($photoId);
    }

    /**
     * Gets photo tags array
     *
     * @param $photoId
     * @return array|mixed|null
     */
    public function getPhotoTagNames($photoId){
        $photo = new Photo;
        return $photo->getPhotoTagNames($photoId);
    }

    /**
     * Gets photos data by tag
     *
     * @param $tagName
     * @return mixed
     */
    public function getPhotosByTagName($tagName){
        $photo = new Photo;
        return $photo->getPhotosByTagName($tagName);
    }

    /**
     * Photo searching by tags
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function searchTag(){
        $tagName = Input::get('photo-search-by-tag');
        return Redirect::to('search/'.$tagName);
    }

/*
 * CATEGORIES
 */

    /**
     * Gets all created categories
     *
     * @return null
     */
    public function getAllExistingCategories(){
        $photo = new Photo;
        return $photo->getAllExistingCategories();
    }

    /**
     * Gets photo category by photo id
     *
     * @param $photoId
     * @return null
     */
    public function getCategoriesData($photoId){
        $photo = new Photo;
        return $photo->getCategoriesData($photoId);
    }

    /**
     * Gets photos by category name
     *
     * @param $catName
     * @return mixed
     */
    public function getPhotosByCatName($catName){
        $photo = new Photo;
        return $photo->getPhotosByCatName($catName);
    }

    /**
     * Creates Category
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createCategory(){
        $photo = new Photo();
        if(Auth::check())
            //if is admin
            if(Auth::user()->role_id == 1){
                $tag = strip_tags(Input::get('catName'));
                $tagDescription = strip_tags(Input::get('catDescription'));
                $photo = new Photo;
                return $photo->createCategory($tag, $tagDescription);
            }
    }

    /**
     * Deletes selected or written category/-ies
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCategory(){

        if(Auth::check())
            //if is admin
            if(Auth::user()->role_id == 1){
                $category = strip_tags(Input::get('category'));
                $selectedCategories = Input::get('categories');
                $photo = new Photo;
                return $photo->deleteCategory($category, $selectedCategories);
            }
    }

/*
 * VIEWS
 */

    /**
     * Count views
     *
     * @param $photoId
     */
    public function countViews($photoId){
        $photo = new Photo();
        $photo->countViews($photoId);
    }

/*
 * SIDEBAR
 */

    /**
     * Gets random photo for sidebar
     *
     * @return mixed
     */
    public function getRandomPhoto(){
        $photo = new Photo();
        return $photo->getRandomPhoto();
    }


    /**
     * Gets most viewed photo for sidebar
     *
     * @return mixed
     */
    public function getMostViewedPhoto(){
        $photo = new Photo();
        return $photo->getMostViewedPhoto();
    }

/*
 * PRIVILEGES
 */

    /**
     * @param $photoId
     * @return int
     */
    public function isUserPhotoCreator($photoId){
        $currentUserId = null;
        if(Auth::check())
            $currentUserId = Auth::user()->id;
        $photo = new Photo();
        return $photo->isUserPhotoCreator($currentUserId, $photoId);
    }


}