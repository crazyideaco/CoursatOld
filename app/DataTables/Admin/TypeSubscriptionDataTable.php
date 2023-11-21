<?php

namespace App\DataTables\Admin;

use App\Student_Type;
use App\TypeJoin;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TypeSubscriptionDataTable extends DataTable
{
    // protected $view = "dashboard.students.basic_subscriptions.";
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
        ->eloquent($query)

        // ->addColumn('action', 'dashboard.type_subscribtions.action')

        ->editColumn("student_name",function($query){
            return $query->student->name ?? "";
        })
        ->editColumn("student_phone",function($query){
            return $query->student->phone ?? "" ?? "";
        })
        ->editColumn("center_name",function($query){
            return $query->type ? ($query->type->center->name ?? "المنصه العامه") : "";
        })
        ->editColumn("teacher_name",function($query){
            return $query->type ? ($query->type->user->name ?? "المنصه العامه") : "";
        })
        ->editColumn("year_name",function($query){
            return $query->type ? ($query->type->year->year_ar ?? " ") : "";
        })
        ->editColumn("subject_name",function($query){
            return $query->type ? ($query->type->subject->name_ar ?? " ") : "";
        })
        ->editColumn("course_name",function($query){
            return $query->type->name_ar ?? "";
        })
        ->editColumn('created_at', function ($row) {
            if ($row->created_at != null) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('Y-m-d');
            } else {
                return 'no date';
            }
        })
        ->editColumn("admin_name",function($query){
            return $query->user->name ?? "";
        })


        ->rawColumns([

            'action',
        ]);
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin/TypeSubscriptionDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Student_Type $model)
    {
        return $model->newQuery()->orderBy("id", "desc");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->parameters([
            // 'dom' => 'Blfrtip',
            'order' => [0, 'desc'],
            'lengthMenu' => [
                [10,25,50,-1],[10,25,50,'all record']
            ],
       'buttons'      => ['export'],
   ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ["data" => "student_name" ,"title" => 'اسم الطالب','exportable'=>false,'orderable'=>false],
             ["data" => "student_phone" ,"title" => 'رقم الطالب','exportable'=>false,'orderable'=>false],
             ["data" => "center_name" ,"title" => 'المنصه','exportable'=>false,'orderable'=>false],
             ["data" => "teacher_name" ,"title" => 'المدرس','exportable'=>false,'orderable'=>false],
             ["data" => "year_name" ,"title" => 'السنه','exportable'=>false,'orderable'=>false],
             ["data" => "subject_name" ,"title" => 'الماده','exportable'=>false,'orderable'=>false],
             ["data" => "course_name" ,"title" => 'الكورس','exportable'=>false,'orderable'=>false],
             ["data" => "created_at" ,"title" => 'تاريخ الانضمام','exportable'=>false,'orderable'=>false],
             ["data" => "admin_name" ,"title" => 'الادمن','exportable'=>false,'orderable'=>false],
             ["data" => "type_format" ,"title" => 'طريقه الاشتراك','exportable'=>false,'orderable'=>false],

            //  ['data'=>'action','title'=>"الاعدادات",'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
           ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin/TypeSubscription_' . date('YmdHis');
    }
}
