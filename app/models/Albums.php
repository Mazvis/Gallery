<?php

/**
 * Class Albums
 */
class Albums{

    /**
     * Creates album
     *
     * @param $currentUserId
     * @param $albumName
     * @param $shortDescription
     * @param $fullDescription
     * @param $placeTaken
     * @return \Illuminate\Http\RedirectResponse redirects page if success
     */
    public function createAlbum($currentUserId, $albumName, $shortDescription, $fullDescription, $placeTaken){

        $success = DB::table('albums')->insert(
            array(
                'album_name' => $albumName,
                'album_short_description' => $shortDescription,
                'album_full_description' => $fullDescription,
                'album_place' => $placeTaken,
                'user_id' => $currentUserId,
            )
        );
        if($success)
            return Redirect::back();
    }

    /**
     * Gets all albums from database
     *
     * @return mixed
     */
    public function getAllAlbums(){
        return DB::select('
        select albums.*, users.username
        from albums
        left join users on albums.user_id = users.id
        order by album_created_at', array());
    }

}