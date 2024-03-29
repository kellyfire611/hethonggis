<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\TinhThanh;

/**
 * Class XaPhuong.
 */
class XaPhuong extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'phuongxa_attributes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['shapeid', 'ID_0', 'ISO', 'NAME_0', 'ID_1', 'NAME_1', 'ID_2', 'NAME_2', 'ID_3', 'NAME_3', 'TYPE_3', 'ENGTYPE_3', 'NL_NAME_3', 'VARNAME_3'];

    protected $primaryKey = 'ID_3';

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.xaphuong.show', $this->ID_3).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.xaphuong.edit', $this->ID_3).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.xaphuong.destroy', $this->ID_3).'"
                data-method="delete"
                data-trans-button-cancel="'.__('buttons.general.cancel').'"
                data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
                data-trans-title="'.__('strings.backend.general.are_you_sure').'"
                class="dropdown-item">'.__('buttons.general.crud.delete').'</a> ';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '
    	<div class="btn-group" role="group" aria-label="'.__('labels.backend.xaphuong.xaphuong_actions').'">
		  '.$this->show_button.'
		  '.$this->edit_button.'

		  <div class="btn-group btn-group-sm" role="group">
			<button id="xaphuongActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  '.__('labels.general.more').'
			</button>
			<div class="dropdown-menu" aria-labelledby="xaphuongActions">
			  '.$this->delete_button.'
			</div>
		  </div>
		</div>';
    }

    public function quanhuyen()
    {
      return $this->belongsTo(QuanHuyen::class, 'ID_2', 'ID_2');
    }
}
