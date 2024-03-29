<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\DichVu;
use App\Models\DiaChi;
use App\Models\DanhGia;
use App\Models\QuanHuyen;

/**
 * Class TourDuLich.
 */
class TourDuLich extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tourdulich';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['matourdulich', 'tentourdulich', 'giatour_nguoilon', 'giatour_treem', 'diemkhoihanh_ten', 'diemkhoihanh_id_quanhuyen', 'diemkhoihanh_toado', 'diemkhoihanh_toado_string', 'diemden_ten', 'diemden_id_quanhuyen', 'diemden_toado', 'diemden_toado_string', 'songaytour', 'hinhanh'];

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.tourdulich.show', $this->id).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.tourdulich.edit', $this->id).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.tourdulich.destroy', $this->id).'"
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
    	<div class="btn-group" role="group" aria-label="'.__('labels.backend.tourdulich.tourdulich_actions').'">
		  '.$this->show_button.'
		  '.$this->edit_button.'

		  <div class="btn-group btn-group-sm" role="group">
			<button id="tourdulichActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  '.__('labels.general.more').'
			</button>
			<div class="dropdown-menu" aria-labelledby="tourdulichActions">
			  '.$this->delete_button.'
			</div>
		  </div>
		</div>';
    }

    public function diemthamquans()
    {
      //return $this->hasMany(DiaDiem::class, 'id_tourdulich', 'id_tourdulich');
      return $this->belongsToMany(DiaDiem::class, 'tourdulich_diemthamquan', 'id_tour', 'id_diemthamquan');
    }

    public function diachi()
    {
      return $this->belongsTo(DiaChi::class);
    }
    public function diemkhoihanhquanhuyen()
    {
      return $this->belongsTo(QuanHuyen::class, 'diemkhoihanh_id_quanhuyen', 'ID_2');
    }
    public function diemdenquanhuyen()
    {
      return $this->belongsTo(QuanHuyen::class, 'diemden_id_quanhuyen', 'ID_2');
    }

    public function danhgias()
    {
      return $this->hasMany(DanhGia::class, 'id_diemthamquan', 'id');
    }
}
