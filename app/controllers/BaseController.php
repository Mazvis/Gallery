<?php

/**
 * Class BaseController
 */
class BaseController extends Controller {

    /**
     * The layout that should be used for responses.
     */
    protected $layout = 'layouts.master';

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        $photoC = new PhotoController();
        $albumC = new AlbumController();
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
            $this->layout->content = '';
            $this->layout->bodyclass = '';
            $this->layout->title = 'Photo Galery';

            //gets all existing categories
            $this->layout->existingCategories = $photoC->getAllExistingCategories();

            //gets 5 recent created albums in gallery
            $this->layout->recentAlbums = $albumC->recentAlbums();

            //gets random photo from gallery
            $randPhoto = $photoC->getRandomPhoto();
            if($randPhoto)
                $randPhoto = $randPhoto[0];
            $this->layout->randomPhoto = $randPhoto;

            //gets most viewed photo in gallery
            $mostViewedPhoto = null;
            $mostViewedPhoto = $photoC->getMostViewedPhoto();

            if($mostViewedPhoto)
                $mostViewedPhoto = $mostViewedPhoto[0];
            $this->layout->mostViewedPhoto = $mostViewedPhoto;
        }
    }

}