<?php namespace App;

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use zgldh\UploadManager\UploadManager;

/**
 * Class Upload
 * @property string $name
 * @property string $description
 * @property string $disk
 * @property string $path
 * @property string $size
 * @property string $user_id
 * @package App
 */
class Upload extends Model
{
    protected $table = 'uploads';

    public static function view($id)
    {
        return Upload::where('id', $id)->get()->first();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getUrlAttribute()
    {
        $manager = UploadManager::getInstance();
        $url = $manager->getUploadUrl($this->disk, $this->path);
        return $url;
    }

    public function deleteFile()
    {
        if ($this->path) {
            $disk = \Storage::disk($this->disk);
            if ($disk->exists($this->path)) {
                $disk->delete($this->path);
                $this->path = '';
                $this->save();
            }
        }
    }

    public function isInDisk($diskName)
    {
        return $this->disk == $diskName ? true : false;
    }

    public function moveToDisk($newDiskName)
    {
        if ($newDiskName == $this->disk) {
            return true;
        }
        $currentDisk = \Storage::disk($this->disk);
        $content = $currentDisk->get($this->path);

        $newDisk = \Storage::disk($newDiskName);
        $newDisk->put($this->path, $content);
        if ($newDisk->exists($this->path)) {
            $this->disk = $newDiskName;
            $this->save();
            $currentDisk->delete($this->path);
            return true;
        }
        return false;
    }
}
