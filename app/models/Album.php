<?php

/**
 * Class Album
 */
class Album{

/*
 * UPLOADING/EDITING
 */

    /**
     * Uploads photo/photos to album
     *
     * @param $currentAlbumId
     * @param $currentUserID
     * @param $photoName
     * @param $shortDescription
     * @param $placeTaken
     * @param $selectedCategories
     * @param $writtenTags
     * @param $photoFile
     * @param $titlePhoto
     * @return mixed
     */
    public function uploadPhoto($currentAlbumId, $currentUserID, $photoName, $shortDescription, $placeTaken, $selectedCategories, $writtenTags, $photoFile, $titlePhoto){

        // upload photo to server
        if ($photoFile != null){

            foreach($photoFile as $file) {
                $destinationPath = 'uploads/albums/'.$currentAlbumId;

                //creates album directory if not exist
                if(!is_dir('uploads'))
                    mkdir('uploads', 0777, true);
                if(!is_dir('uploads/albums'))
                    mkdir('uploads/albums', 0777, true);
                if(!is_dir('uploads/albums/'.$currentAlbumId))
                    mkdir('uploads/albums/'.$currentAlbumId, 0777, true);

                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileSize = $file->getSize();

                if($extension == 'jepg' || $extension == 'jpg' || $extension == 'bmp' || $extension == 'png' || $extension == 'gif')
                    if($fileSize <= 1024*1024*3){
                        //make: if this albumId exist in albums table do this insert
                        $isAlbumIdExist = DB::select('select album_id from albums where album_id = ?', array($currentAlbumId));
                        if($isAlbumIdExist){
                            //upload photo in database
                            $insertedPhotoId = DB::table('photos')->insertGetId(
                                array('photo_name' => $photoName,
                                    'photo_short_description' => $shortDescription,
                                    'photo_taken_at' => $placeTaken,
                                    'album_id' => $currentAlbumId,
                                    'user_id' => $currentUserID,
                                    'photo_size' => $fileSize
                                )
                            );

                            $explodedTags = preg_replace("/[^\w\ _]+/", '', $writtenTags); // strip all punctuation characters, news lines, etc.
                            $explodedTags = preg_split("/\s+/", $explodedTags); // split by left over spaces
                            $tagLine = "";
                            for($i=0; $i<sizeOf($explodedTags); $i++)
                                $tagLine = $tagLine.$explodedTags[$i].", ";
                            $tagLine = substr($tagLine, 0, -2);

                            DB::insert('insert into photo_tags (photo_id, tags) values (?,?)', array($insertedPhotoId, $tagLine));



                            $upload_success = $file->move($destinationPath, $insertedPhotoId.".".$extension);
                            if($upload_success){
                                //makes photo thumb
                                $fileForThumb = $destinationPath."/".$insertedPhotoId.".".$extension;
                                App::make('phpthumb')
                                ->create('resize', array($fileForThumb, 200, 200, 'adaptive'))
                                ->save($destinationPath."/", $insertedPhotoId."_thumb.".$extension);

                                DB::update('update photos set
                                photo_destination_url = ?,
                                photo_thumbnail_destination_url = ?
                                where photo_id = ?',
                                    array(
                                        $destinationPath."/".$insertedPhotoId.".".$extension,
                                        $destinationPath."/".$insertedPhotoId."_thumb.".$extension,
                                        $insertedPhotoId));
                            }

                            //add categories
                            for($i = 0; $i < sizeOf($selectedCategories); $i++){
                                $catId = DB::select('select * from categories where category_name = ?', array($selectedCategories[$i]));
                                if($catId)
                                    DB::table('photo_categories')->insert(
                                        array(
                                            'photo_id' => $insertedPhotoId,
                                            'category_id' => $catId[0]->category_id,
                                        )
                                    );
                            }
                            //-----------------Editing album title photo data---------------------//
                            //if 'make uploaded photo to title album photo' property is selected
                            if($titlePhoto){

                                //gets old title url
                                $titlePhoto = DB::table('albums')->where('album_id', $currentAlbumId)->get();

                                //if album exist
                                if($titlePhoto != null){

                                    //deletes old title photo if exists from directory
                                    $oldAlbumTitlePhoto = null;
                                    $oldAlbumTitlePhoto = $titlePhoto[0]->album_title_photo_url;
                                    if($oldAlbumTitlePhoto != null ){
                                        if(is_file($oldAlbumTitlePhoto))
                                            File::delete($oldAlbumTitlePhoto);
                                    }
                                    //deletes old title photo thumb if exists from directory
                                    $oldAlbumTitlePhotoThumb = null;
                                    $oldAlbumTitlePhotoThumb = $titlePhoto[0]->album_title_photo_thumb_url;
                                    if($oldAlbumTitlePhotoThumb != null )
                                        if(is_file($oldAlbumTitlePhotoThumb))
                                            File::delete($oldAlbumTitlePhotoThumb);
                                }

                                //gets current photo url
                                $newTitlePhoto = DB::table('photos')->where('photo_id', $insertedPhotoId)->get();
                                if($newTitlePhoto){

                                    //photo
                                    $photo = null;
                                    $photo = $newTitlePhoto[0]->photo_destination_url;
                                    if($photo != null ){
                                        if(is_file($photo)){
                                            $photoExtension = File::extension($photo);
                                            $newPhoto = $destinationPath."/title_".$currentAlbumId.".".$photoExtension;
                                            File::copy($photo, $newPhoto);
                                            $photo = $newPhoto;
                                        }
                                    }

                                    //thumb
                                    $photoThumb = null;
                                    $photoThumb = $newTitlePhoto[0]->photo_thumbnail_destination_url;
                                    if($photoThumb != null){
                                        if(is_file($photoThumb)){
                                            $thumbExtension = File::extension($photoThumb);
                                            $newPhotoThumbUrl = $destinationPath."/title_".$currentAlbumId."_thumb.".$thumbExtension;
                                            File::copy($photoThumb, $newPhotoThumbUrl);
                                            $photoThumb = $newPhotoThumbUrl;
                                        }
                                    }
                                    else if($photoThumb == null && is_file($photo) != null){
                                        App::make('phpthumb')
                                            ->create('resize', array($photo, 200, 200, 'adaptive'))
                                            ->save($destinationPath."/", "title_".$currentAlbumId."_thumb.".$photoExtension);
                                        $photoThumb = $destinationPath."/title_".$currentAlbumId."_thumb.".$photoExtension;
                                    }

                                    //insert uploaded/unuploaded files to database
                                    DB::table('albums')
                                        ->where('album_id', $currentAlbumId)
                                        ->update(array(
                                            'album_title_photo_url' => $photo,
                                            'album_title_photo_thumb_url' => $photoThumb
                                        ));
                                }
                            }
                    }
                }
            }
        }
        return $insertedPhotoId;
    }

    /**
     * Gets values from inputs ant edits album data
     *
     * @param $currentAlbumId
     * @param $currentUserID
     * @param $albumName
     * @param $shortDescription
     * @param $fullDescription
     * @param $placeTaken
     * @param $titlePhotoFile
     */
    public function editAlbum($currentAlbumId, $currentUserID, $albumName, $shortDescription, $fullDescription, $placeTaken, $titlePhotoFile){

        DB::table('albums')
            ->where('album_id', $currentAlbumId)
            ->update(array(
                    'album_name' => $albumName,
                    'album_short_description' => $shortDescription,
                    'album_full_description' => $fullDescription,
                    'album_place' => $placeTaken
                )
            );

        if ($titlePhotoFile != null){
            $file = $titlePhotoFile;

            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();

            if($extension == 'jepg' || $extension == 'jpg' || $extension == 'bmp' || $extension == 'png' || $extension == 'gif')
                //max is 3MG
                if($fileSize <= 1024*1024*3){

                    //make: if this albumId exist in albums table do this insert
                    $isAlbumIdExist = DB::select('select album_id from albums where album_id = ?', array($currentAlbumId));
                    if($isAlbumIdExist){

                        $titleDestinationPath = 'uploads/albums/'.$currentAlbumId;

                        //creates album directory if not exist
                        if(!is_dir('uploads'))
                            mkdir('uploads', 0777, true);
                        if(!is_dir('uploads/albums'))
                            mkdir('uploads/albums', 0777, true);
                        if(!is_dir('uploads/albums/'.$currentAlbumId))
                            mkdir('uploads/albums/'.$currentAlbumId, 0777, true);

                        //gets old title url
                        $titlePhoto = DB::table('albums')->where('album_id', $currentAlbumId)->get();

                        //if album exist
                        if($titlePhoto != null){

                            //deletes old title photo if exists from directory
                            $oldAlbumTitlePhoto = null;
                            $oldAlbumTitlePhoto = $titlePhoto[0]->album_title_photo_url;
                            if($oldAlbumTitlePhoto != null ){
                                if(is_file($oldAlbumTitlePhoto))
                                    File::delete($oldAlbumTitlePhoto);
                            }
                            //deletes old title photo thumb if exists from directory
                            $oldAlbumTitlePhotoThumb = null;
                            $oldAlbumTitlePhotoThumb = $titlePhoto[0]->album_title_photo_thumb_url;
                            if($oldAlbumTitlePhotoThumb != null )
                                if(is_file($oldAlbumTitlePhotoThumb))
                                    File::delete($oldAlbumTitlePhotoThumb);
                        }

                        //new title photo url
                        $newTitlePhotoUrl = $titleDestinationPath."/title_".$currentAlbumId.".".$extension;

                        //upload file to directory
                        $upload_success = $file->move($titleDestinationPath, "title_".$currentAlbumId.".".$extension);
                        if($upload_success){
                            App::make('phpthumb')
                                ->create('resize', array($newTitlePhotoUrl, 200, 200, 'adaptive'))
                                ->save($titleDestinationPath."/", "title_".$currentAlbumId."_thumb.".$extension);

                            $photoThumb = $titleDestinationPath."/title_".$currentAlbumId."_thumb.".$extension;

                            //insert uploaded/unuploded files to database
                            DB::table('albums')
                                ->where('album_id', $currentAlbumId)
                                ->update(array(
                                    'album_title_photo_url' => $newTitlePhotoUrl,
                                    'album_title_photo_thumb_url' => $photoThumb
                                ));
                        }
                    }
                }
        }

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
        return DB::select('select * from photos where album_id = ?', array($albumId));
    }

    /**
     * Gets single album data
     *
     * @param $albumId
     * @return mixed
     */
    public function getAlbumDataByAlbumId($albumId){
        $albums = DB::select('SELECT albums . * , users.username, COUNT( photos.photo_id ) AS album_photos_count
        FROM albums
        LEFT JOIN users ON albums.user_id = users.id
        LEFT JOIN photos ON albums.album_id = photos.album_id
        WHERE albums.album_id = ?
        GROUP BY albums.album_id', array($albumId));

        return $albums;
    }

/*
 * DELETES
 */

    /**/

    /*
     * Deletes photo from album page by photo_id
     *
     * @param int $photoId
     * @return string if delete is success
     */
    public function deletePhoto($photoId){
        $photos = DB::select('select * from photos where photo_id = ?', array($photoId));
        if($photos){
            File::delete($photos[0]->photo_destination_url);

            DB::table('photos')->where('photo_id', $photoId)->delete();
            //DB::table('albums')->where('album_title_photo_id', $photoId)->update(array('album_title_photo_id' => null)); //???
        }
        return "Deleted";
    }

    /*
     * Deletes all album data
     *
     * @param int $albumId
     * @return string if delete is success
     */
    public function deleteAlbum($albumId){

        //deletes all album likes
        DB::delete('delete from likes where album_id = ?', array($albumId));

        //deletes all album comments
        DB::delete('delete from comments where album_id = ?', array($albumId));

        $photos = DB::table('photos')->where('album_id', $albumId)->get();

        //if exist photos in this album
        if($photos){
            //deletes album directory
            $albums = DB::table('albums')->where('album_id', $albumId)->get();
            $userId = $albums[0]->user_id;
            File::deleteDirectory('uploads/'.$userId.'/albums/'.$albumId);

            //deletes all album photo likes
            foreach($photos as $photo)
                DB::delete('delete from likes where photo_id = ?', array($photo->photo_id));

            //deletes all album photo comments
            foreach($photos as $photo)
                DB::delete('delete from comments where photo_id = ?', array($photo->photo_id));

            //delete all added album photo tags
            $photoTagsIds = DB::select('SELECT photo_tags.photo_tag_id
            FROM photos
            LEFT JOIN albums ON photos.album_id = albums.album_id
            LEFT JOIN photo_tags ON photos.photo_id = photo_tags.photo_id
            WHERE albums.album_id = ?
            GROUP BY photo_tags.photo_tag_id',array($albumId));
            foreach($photoTagsIds as $photoTagsId)
                //delete all added album photos tags
                DB::table('photo_tags')->where('photo_tag_id', $photoTagsId->photo_tag_id)->delete();

            //deletes all album photos data from database
            DB::table('photos')->where('album_id', $albumId)->delete();
        }
        //deletes album data from database
        DB::table('albums')->where('album_id', $albumId)->delete();

        return 'Deleted';
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
        return DB::select('SELECT likes.*, users.username
        FROM likes
        LEFT JOIN users ON likes.user_id = users.id
        WHERE album_id = ?', array($albumId));
    }

    /**
     * Checks if user is already liked current album
     *
     * @param $albumId
     * @param $currentUserID
     * @return int
     */
    public function isLikeAlreadyExists($albumId, $currentUserID){
        $likes = DB::select('select * from likes where album_id = ? and user_id = ?', array($albumId, $currentUserID));
        if($likes)
            return 1;
        return 0;
    }

    /**
     * Makes like in album
     *
     * @param $albumId
     * @param $currentUserID
     * @return mixed
     */
    public function makeLike($albumId, $currentUserID){
        $isExist = $this->isLikeAlreadyExists($albumId, $currentUserID);
        if($isExist == 0 && $currentUserID != null){
            DB::table('likes')->insert(
                array(
                    'album_id' => $albumId,
                    'user_id' => $currentUserID,
                )
            );
        }
        else if($isExist == 1)
            DB::delete('delete from likes where album_id = ? and user_id = ?', array($albumId, $currentUserID));

        return $currentUserID;
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
        return DB::select('SELECT comments.*, users.username
        FROM comments
        LEFT JOIN users ON comments.user_id = users.id
        WHERE album_id = ?', array($albumId));
    }

    /**
     * Writes comment
     *
     * @param $comment
     * @param $currentAlbumId
     * @param $currentUserID
     * @param $posterIp
     * @return mixed
     */
    public function writeComment($comment, $currentAlbumId, $currentUserID, $posterIp){
        //if album exists
        if(DB::table('albums')->where('album_id',$currentAlbumId)->get()){
            DB::table('comments')->insert(
                array(
                    'comment' => $comment,
                    'album_id' => $currentAlbumId,
                    'user_id' => $currentUserID,
                    'commenter_ip' => $posterIp,
                )
            );
            return $comment;
        }
    }

    /**
     * Deletes selected comment
     *
     * @param $commentId
     * @return string
     */
    public function deleteComment($commentId){
        $comment = DB::select('SELECT user_id FROM comments where comment_id = ?', array($commentId));
        //if comment exists
        if($comment)
            if($comment[0]->user_id == Auth::user()->id || Auth::user()->role_id == 1)
                if(DB::delete('delete from comments where comment_id = ?', array($commentId)))
                    return "Deleted";
    }

/*
 * VIEWS
 */

    /**
     * Count album views
     *
     * @param $albumId
     */
    public function countViews($albumId){
        DB::update('update albums set views = views+1 where album_id = ?', array($albumId));
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
        $albums = DB::select('
        select albums.*
        from albums
        where albums.user_id = ?
        order by album_created_at', array($userId));
        return $albums;
    }

    /**
     * Checks if user is album creator
     *
     * @param $currentUserId
     * @param $albumId
     * @return int
     */
    public function isUserAlbumCreator($currentUserId, $albumId){
        $ifUser = DB::select('
        select users.id
        from users
        left join albums
        on albums.user_id = users.id
        where albums.user_id = ?
        and albums.album_id = ?', array($currentUserId, $albumId));

        if($ifUser)
            return 1;
        return 0;
    }

    /**
     * @param $albums
     * @return null
     */
    public function isAlbumsCreatorForAlbumsTemplate($albums){
        if(Auth::check()){
            $i = 0;
            $array = null;
            foreach($albums as $album){
                if($this->isUserAlbumCreator(Auth::user()->id, $album->album_id) || Auth::user()->role_id == 1){
                    $array[$i] = 1;
                }
                else
                    $array[$i] = 0;
                $i++;
            }
            return $array;
        }
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
        return DB::select('select * from albums order by albums.album_created_at DESC limit 5');
    }
}