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
     * @param $selectedCategories
     * @return \Illuminate\Http\RedirectResponse redirects page if success
     */
    public function createAlbum($currentUserId, $albumName, $shortDescription, $fullDescription, $placeTaken, $selectedCategories){

        $insertedAlbumId = DB::table('albums')->insertGetId(
            array(
                'album_name' => $albumName,
                'album_short_description' => $shortDescription,
                'album_full_description' => $fullDescription,
                'album_place' => $placeTaken,
                'user_id' => $currentUserId,
            )
        );

        //add categories
        for($i = 0; $i < sizeOf($selectedCategories); $i++){
            $catId = DB::select('select * from categories where category_name = ?', array($selectedCategories[$i]));
            if($catId) {
                DB::table('album_categories')->insert(
                    array(
                        'album_id' => $insertedAlbumId,
                        'category_id' => $catId[0]->category_id,
                    )
                );
            }
        }

        if($insertedAlbumId != false)
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