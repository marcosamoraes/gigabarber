<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAttribute extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'client_id';

    protected $fillable = [
        'client_id',
        'title',
        'description',
        'public_email',
        'image',
        'primary_color',
        'text_color',
        'description_footer',
        'link_facebook',
        'link_instagram',
        'opening_hours',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
