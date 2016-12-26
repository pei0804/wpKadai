<?php
use Slimvc\Base\Model;

class Reportcates extends Model {

    protected $table = 'reportcates';
    protected $fillable = ['rc_name', 'rc_note' ,'rc_list_flg', 'rc_order'];

    public function reports()
    {
        return $this->hasMany('Reports');
    }
}