<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cabin_size',
        'mirror_size',
        'has_mirror',
        'color_id',
        'cabin_material_id',
        'surface_material_id',
        'bowl_material_id',
        'mirror_material_id',
        'drawer_material_id',
        'attachment_id',
        'description',
        'total_price',
        'state',
        'admin_comment',
        'tracking_code',
        'arrival_date',
        'post_price',
        'address_id'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function attachment()
    {
        return $this->belongsTo(Attachment::class);
    }

    function bowl_material()
    {
        return $this->belongsTo(Material::class, 'bowl_material_id');
    }

    function cabin_material()
    {
        return $this->belongsTo(Material::class, 'cabin_material_id');
    }

    function surface_material()
    {
        return $this->belongsTo(Material::class, 'surface_material_id');
    }

    function mirror_material()
    {
        return $this->belongsTo(Material::class, 'mirror_material_id');
    }

    function drawer_material()
    {
        return $this->belongsTo(Material::class, 'drawer_material_id');
    }

    function color()
    {
        return $this->belongsTo(Color::class);
    }
    function address(){
        return $this->belongsTo(Address::class);

    }


}
