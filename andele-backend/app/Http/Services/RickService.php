<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class RickService
{
    private const URL='https://rickandmortyapi.com/api/character';

    /**
     * @param int $page
     * @return mixed
     */
    private static function getPageByNumber(int $page=1)
    {
        return Http::get(self::URL.'/?page='.$page)->json();
    }

    /**
     * @return mixed
     */
    public static function getRandomPage()
    {
        if (Session::missing('rick_pages')) {
            $page= self::getPageByNumber(1);
            $maxPages=$page['info']['pages'];
            Session::put('rick_pages',$maxPages);
        } else {
            $maxPages=Session::get('rick_pages');
        }
        $page=rand(1,$maxPages);
        return self::getPageByNumber($page);
    }

    public static function getCharacter(int $id=1)
    {
        return Http::get(self::URL.'/'.$id)->json();
    }
}
