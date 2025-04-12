<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectsExport implements FromQuery, WithHeadings
{

    protected $customerId;

    public function __construct($customerId)
    {
        $this->customerId = $customerId;
    }

    public function query()
    {
        return Project::where('plist_customer_id', $this->customerId);
    }

    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Project::all();
    // }

    public function headings(): array
    {
        return [
            'plist_customer_id', 'plist_projectid', 'plist_title', 
            'plist_description', 'plist_type', 'plist_country', 
            'plist_state', 'plist_city', 'plist_pincode', 'plist_startdate', 
            'plist_enddate', 'plist_currency', 'plist_budget', 'plist_name', 'plist_email', 'plist_contact', 
            'plist_status', 'plist_delivered_on', 'plist_customeremail', 'plist_project_status', 
            'plist_ongnew', 'plist_category', 'plist_project_status_description', 'created_at'
        ];
    }
}
