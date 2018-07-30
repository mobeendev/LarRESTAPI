<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $fillable = ['name', 'sub_category_id'];

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function delete() {
        DB::transaction(function() {
            $this->products()->detach();
            parent::delete();
        });
    }

}
