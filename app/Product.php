<?php
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = ['title', 'description', 'price', 'availability'];

    public function categories() {
        return $this->belongsToMany(Category::class);
//                        ->withPivot('size', 'color');
    }

    public function delete() {
        DB::transaction(function() {
            $this->categories()->detach();
            parent::delete();
        });
    }

}
