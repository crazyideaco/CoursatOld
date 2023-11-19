<?php

namespace App\DataTables\Admin;

use App\Models\Patch;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubTypePatchDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {
        return datatables()
        ->eloquent($query)

        ->addColumn('action', 'dashboard.patches.action')
        ->editColumn("created_by",function($query){
            return $query->createable->name;
        })
        ->editColumn('created_at', function ($row) {
            if ($row->created_at != null) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('Y-m-d');
            } else {
                return 'no date';
            }
        })
        ->rawColumns([

            'action',
        ]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Patch $model): QueryBuilder
    {
        return $model->newQuery()->orderBy("id", "desc")->where([['course_id','=',$this->id],['course_type','=','SubType']]);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->parameters([
            'dom' => 'Blfrtip',
            'order' => [0, 'desc'],
            'lengthMenu' => [
                [10,25,50,-1],[10,25,50,'all record']
            ],
       'buttons'      => ['export'],
   ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            ["data" => "id" ,"title" => 'ID'],
             ["data" => "created_by" ,"title" => 'created by'],
             ["data" => "count" ,"title" => 'العدد'],
             ["data" => "created_at" ,"title" => 'الوقت'],

             ['data'=>'action','title'=>"الاعدادات",'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
           ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'QrcodePatch_' . date('YmdHis');
    }
}
