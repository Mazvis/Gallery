<?php

/**
 * Class HomeController
 */
class HomeController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    /**
     * Show home page.
     */
    public function showHome() {
        $this->layout->content = View::make('home');
        $this->layout->bodyclass = "home-page";

        $photo = new Photo();
        $this->layout->content->photo_data_array2 = $photo->getAllPhotoData();
    }

    /**
     * Show the user profile page.
     */
    public function showProfile() {
        if(Auth::check()){
            $this->layout->bodyclass = "home-page";
            $value = Session::get('user.id', Auth::user()->id);
            $this->layout->content = View::make('profile', array('user' => User::find($value)));

            $album = new AlbumController();
            $this->layout->content->userAlbums = $album->getAllUserAlbums(Auth::user()->id);
        }
        else
            return Redirect::to('login');
    }

    /*
     * Show admin panel.
     */
    public function showPanel()
    {
        if(Auth::check()){
            $this->layout->bodyclass = "home-page";
            $value = Session::get('user.id', Auth::user()->id);
            $this->layout->content = View::make('panel', array('user' => User::find($value)));

            $album = new AlbumController();
            $this->layout->content->userAlbums = $album->getAllUserAlbums(Auth::user()->id);

            $photo = new PhotoController();
            //$this->layout->content->allExistingTags = $photo->getAllExistingTags();
            $cat = $photo->getAllExistingCategories();
            if($cat)
                $this->layout->content->allExistingCategories = $cat;
        }
        else
            return Redirect::to('404');
    }

    public function showProfilePost()
    {
        $rules = array('first_name' => 'required|min:3|max:80|alpha',
            'last_name' => 'required|min:3|max:80|alpha');

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('profile')->withErrors($validator);
        }
    }

    /*
     * Show user profile.
     */
    public function showUserProfile($username)
    {
        $userModel = new User();
        $userData = $userModel->getUserDataByUserName($username);

        if($userData){
            if(Auth::check() && Auth::user()->id == $userData[0]->id)
                return Redirect::to('profile');
            else{
                $this->layout->content = View::make('user', array('user' => User::find($userData[0]->id)));
                $this->layout->bodyclass = "home-page";

                $album = new AlbumController();
                $this->layout->content->userAlbums = $album->getAllUserAlbums($userData[0]->id);

                $albumM = new Album();
                $this->layout->content->isAlbumCreator = $albumM->isAlbumsCreatorForAlbumsTemplate($album->getAllUserAlbums($userData[0]->id));
            }
        }
        else
            $this->showNotFoundPage();
    }

    /**
     * Show the login page.
     */
    public function showLogin() {
        if(Auth::check())
            return Redirect::to("/");
        $this->layout->content = View::make('login');
        $this->layout->bodyclass = "home-page";
    }

    /**
     * Show the all albums page.
     */
    public function showAlbums() {
        $this->layout->content = View::make('albums');
        $this->layout->bodyclass = "home-page";

        $albums = new AlbumsController();
        $this->layout->content->allAlbums = $albums->getAllAlbums();

        $this->layout->content->isAlbumCreator = $albums->isAlbumCreator();
    }

    /**
     * Show the album page.
     */
    public function showSingleAlbum($albumId)
    {
        $photo = new PhotoController();
        $album = new AlbumController();

        $albumData = $album->getAlbumDataByAlbumId($albumId);
        //if album exist
        if($albumData){
            $this->layout->content = View::make('singlealbum', array('albumId' => $albumId));
            $this->layout->bodyclass = "home-page";

            $album->countViews($albumId);
            $this->layout->content->albumId = $albumId;


            $this->layout->content->albumPhotos = $album->getAlbumPhotos($albumId);

            $albumData = $album->getAlbumDataByAlbumId($albumId);
            $this->layout->content->albumData = $albumData[0];

            //likes
            $this->layout->content->likes = $album->getAlbumLikes($albumId);
            $this->layout->content->isLikeAlreadyExists = $album->isLikeAlreadyExists($albumId);

            //comments
            $this->layout->content->comments = $album->getAlbumComments($albumId);

            //categories
            $this->layout->content->allExistingCategories = $photo->getAllExistingCategories();

            //roles
            $this->layout->content->isUserHavingPrivilegies = $album->isUserHavingPrivilegies($albumId);

            $this->layout->content->isUserAlbumCreator = $album->isUserAlbumCreator($albumId);
        }
        else
            $this->showNotFoundPage();
    }

    /*
    * Show the photo page.
    */
    public function showSinglePhoto($albumId, $photoId) {

        $photo = new PhotoController();

        //if photo and album exist
        $photoData = $photo->getPhotoDataByPhotoId($photoId, $albumId);
        if($photoData){
            $this->layout->content = View::make('singlephoto', array('albumId' => $albumId, 'photoId' => $photoId));
            $this->layout->bodyclass = "home-page";

            $photo->countViews($photoId);
            //photo data
            $photoData = $photo->getPhotoDataByPhotoId($photoId, $albumId);
            $this->layout->content->photoData = $photoData[0];

            //tags
            //$this->layout->content->tags = $photo->getTagsData($photoId);
            $this->layout->content->photoTags = $photo->getPhotoTagsRow($photoId);
            $this->layout->content->photoTagNames = $photo->getPhotoTagNames($photoId);

            //$this->layout->content->allExistingTags = $photo->getAllExistingTags();

            //categories
            $this->layout->content->categories = $photo->getCategoriesData($photoId);
            $this->layout->content->allExistingCategories = $photo->getAllExistingCategories();

            //likes
            $this->layout->content->likes = $photo->getPhotoLikes($photoId);
            $this->layout->content->isLikeAlreadyExists = $photo->isLikeAlreadyExists($photoId);

            //comments
            $this->layout->content->comments = $photo->getPhotoComments($photoId);

            $this->layout->content->isPhotoCreator = $photo->isUserPhotoCreator($photoId);
        }
        else
            $this->showNotFoundPage();
    }

    /*
     * Show tag page
     */
    public function showTagPage($tagName) {
        $photo = new PhotoController();

        //$tag = $photo->getTagData($tagName);
        $photos = $photo->getPhotosByTagName($tagName);
        //var_dump($photos);
        //if this tag exists
            $this->layout->content = View::make('tag', array('tagName' => $tagName));
            $this->layout->bodyclass = "home-page";

            //$this->layout->content->photos = $photo->getPhotoDataByTagId($tag[0]->tag_id);
            $this->layout->content->photos = $photos;

        $photoM = new Photo();
        $this->layout->content->isPhotoCreator = $photoM->isPhotoCreatorForPhotosTemplate($photos);
    }

    /*
     * Show category page
     */
    public function showCategoryPage($catName) {
        $photo = new PhotoController();

        $photos = $photo->getPhotosByCatName($catName);

        $this->layout->content = View::make('category', array('catName' => $catName));
        $this->layout->bodyclass = "home-page";

        $this->layout->content->photos = $photos;

        $photoM = new Photo();
        $this->layout->content->isPhotoCreator = $photoM->isPhotoCreatorForPhotosTemplate($photos);
    }

    /*
     * Show search page
     */
    public function showSearchPage($tagName) {
        $photo = new PhotoController();

        $photos = $photo->getPhotosByTagName($tagName);

        $this->layout->content = View::make('tag', array('tagName' => $tagName));
        $this->layout->bodyclass = "home-page";

        $this->layout->content->photos = $photos;

        $photoM = new Photo();
        $this->layout->content->isPhotoCreator = $photoM->isPhotoCreatorForPhotosTemplate($photos);
    }

    /**
     * Show the 404 page.
     */
    public function showNotFoundPage() {
        $this->layout->content = View::make('404');
        $this->layout->bodyclass = "home-page";
    }

    /**
     * Show the registration page.
     */
    public function showRegistration()
    {
        if(Auth::check())
            return Redirect::to("/");
        $this->layout->content = View::make('registration');
        $this->layout->bodyclass = "home-page";
    }

}