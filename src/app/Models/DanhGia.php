<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\DichVu;
use App\Models\DiaChi;
use App\Models\DiaDiem;

/**
 * Class DanhGia.
 */
class DanhGia extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'danhgia';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'first_name', 'last_name', 'noidung', 'diem', 'trangthai'];

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.danhgia.show', $this->id).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.danhgia.edit', $this->id).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.danhgia.destroy', $this->id).'"
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
    	<div class="btn-group" role="group" aria-label="'.__('labels.backend.danhgia.danhgia_actions').'">
		  '.$this->show_button.'
		  '.$this->edit_button.'

		  <div class="btn-group btn-group-sm" role="group">
			<button id="danhgiaActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  '.__('labels.general.more').'
			</button>
			<div class="dropdown-menu" aria-labelledby="danhgiaActions">
			  '.$this->delete_button.'
			</div>
		  </div>
		</div>';
    }

    public function diadiem()
    {
      return $this->belongsTo(DiaDiem::class);
    }
}
