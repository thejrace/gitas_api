<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FtsVersion
 *
 * @property int $id
 * @property int $major
 * @property int $minor
 * @property int $patch
 * @property string|null $change_log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FtsVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FtsVersion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FtsVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FtsVersion whereChangeLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FtsVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FtsVersion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FtsVersion whereMajor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FtsVersion whereMinor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FtsVersion wherePatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FtsVersion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FtsVersion extends Model
{
    protected $guarded = [];

    public function fullVersion()
    {
        return $this->major . '_' . $this->minor . '_' . $this->patch;
    }

    public function downloadUrl()
    {
        return 'http://gitfilo.com/fts_download/fts_' . $this->fullVersion();
    }
}
