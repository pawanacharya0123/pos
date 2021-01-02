<?php

namespace App\Traits;

use App\File;

trait ProductHistory
{
	public  function addHistory($text){
		return;
	}
    
    public function file()
    {
        return $this->morphOne(File::class, 'uploadable')->oldest('id');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'uploadable');
    }

}