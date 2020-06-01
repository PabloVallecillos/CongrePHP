<?php

namespace App\Traits;

trait YoutubeTrait 
{
    function get_youtube_video_ID($youtube_video_url) 
    {
        $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
        // Checks if it matches a pattern and returns the value
        if (preg_match($pattern, $youtube_video_url, $match)) 
        {
            return $match[1];
        }
      
        // if no match return false.
        return false;
    }
}