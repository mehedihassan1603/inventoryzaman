<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'date',
        'user_id',
        'customer_id',
        'warehouse_id',
        'company_name',
        'contact_person',
        'designation',
        'contact_number',
        'email',
        'head_office',
        'factory',
        'requirement',
        'reffer',
        'remark',
    ];
    // app/Models/Inquiry.php

public function company()
{
    return $this->belongsTo(Company::class, 'company_name'); // or use 'App\Models\Company' if needed
}

}
