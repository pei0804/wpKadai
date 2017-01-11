<?php
use Slimvc\Base\Model;

class Reports extends Model
{
    protected $table = 'reports';
    protected $fillable = ['rp_date', 'rp_time_from', 'rp_time_to', 'rp_content', 'rp_created_at' , 'reportcate_id', 'user_id'];

    public function users()
    {
        return $this->belongsTo('Users', 'user_id');
    }

    public function reportcates()
    {
        return $this->belongsTo('Reportcates', 'reportcate_id');
    }

    protected static function rules()
    {
        return [
            'rp_date'     => ['required', 'date_format:Y-m-d'],
            'rp_time_from'     => ['required', 'date_format:H:i:s'],
            'rp_time_to' => ['required', 'date_format:H:i:s', 'after:rp_time_from'],
            'rp_content' => ['required', 'string'],
            'reportcate_id' => ['required', 'integer'],
        ];
    }
}